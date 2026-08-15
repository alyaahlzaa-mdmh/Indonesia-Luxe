<?php

use App\Enums\PackageStatus;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use App\Services\CartService;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->cartService = app(CartService::class);

    $this->customer = User::factory()->customer()->create();

    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    $this->package = TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'price_per_person' => 500000,
    ]);

    $this->slot = TourDepartureSlot::factory()->create([
        'tour_package_id' => $this->package->id,
        'quota' => 10,
        'booked_count' => 0,
        'price_per_person' => 500000,
    ]);
});

it('creates cart for user if not exists', function () {
    $cart = $this->cartService->getOrCreateCart($this->customer);

    expect($cart)->toBeInstanceOf(Cart::class)
        ->and($cart->user_id)->toBe($this->customer->id);
});

it('returns existing cart', function () {
    $cart1 = $this->cartService->getOrCreateCart($this->customer);
    $cart2 = $this->cartService->getOrCreateCart($this->customer);

    expect($cart1->id)->toBe($cart2->id);
});

it('can add item to cart', function () {
    $cart = $this->cartService->addItem($this->customer, $this->slot, 2);

    expect($cart->items)->toHaveCount(1)
        ->and($cart->items->first()->quantity)->toBe(2)
        ->and((float) $cart->items->first()->line_total)->toBe(1000000.0);
});

it('increments existing item quantity when adding same slot', function () {
    $this->cartService->addItem($this->customer, $this->slot, 2);
    $cart = $this->cartService->addItem($this->customer, $this->slot, 3);

    expect($cart->items)->toHaveCount(1)
        ->and($cart->items->first()->quantity)->toBe(5);
});

it('creates separate cart rows for same slot with different pickup points', function () {
    $this->cartService->addItem($this->customer, $this->slot, 2, 'Labuan Bajo Airport');
    $cart = $this->cartService->addItem($this->customer, $this->slot, 3, 'Hotel Labuan Bajo');

    expect($cart->items)->toHaveCount(2)
        ->and($cart->items->pluck('pickup_point')->sort()->values()->all())
        ->toBe(['Hotel Labuan Bajo', 'Labuan Bajo Airport']);
});

it('rejects adding beyond available quota across pickup points', function () {
    $this->slot->update(['quota' => 5, 'booked_count' => 0]);

    $this->cartService->addItem($this->customer, $this->slot, 3, 'Labuan Bajo Airport');
    $this->cartService->addItem($this->customer, $this->slot, 3, 'Hotel Labuan Bajo');
})->throws(ValidationException::class);

it('rejects adding quantity less than 1', function () {
    $this->cartService->addItem($this->customer, $this->slot, 0);
})->throws(ValidationException::class);

it('rejects adding beyond available quota', function () {
    $this->slot->update(['quota' => 3, 'booked_count' => 0]);

    $this->cartService->addItem($this->customer, $this->slot, 5);
})->throws(ValidationException::class);

it('can update cart item quantity', function () {
    $cart = $this->cartService->addItem($this->customer, $this->slot, 2);
    $item = $cart->items->first();
    $item->load(['slot', 'cart.user']);

    $updatedCart = $this->cartService->updateItem($item, 4);

    expect($updatedCart->items->first()->quantity)->toBe(4);
});

it('rejects updating with quantity less than 1', function () {
    $cart = $this->cartService->addItem($this->customer, $this->slot, 2);
    $item = $cart->items->first();
    $item->load(['slot', 'cart.user']);

    $this->cartService->updateItem($item, 0);
})->throws(ValidationException::class);

it('rejects updating beyond available quota', function () {
    $this->slot->update(['quota' => 5, 'booked_count' => 0]);

    $cart = $this->cartService->addItem($this->customer, $this->slot, 2);
    $item = $cart->items->first();
    $item->load(['slot', 'cart.user']);

    $this->cartService->updateItem($item, 10);
})->throws(ValidationException::class);

it('rejects updating beyond available quota across pickup points', function () {
    $this->slot->update(['quota' => 5, 'booked_count' => 0]);

    $cart = $this->cartService->addItem($this->customer, $this->slot, 2, 'Labuan Bajo Airport');
    $this->cartService->addItem($this->customer, $this->slot, 3, 'Hotel Labuan Bajo');

    $item = $cart->items->firstWhere('pickup_point', 'Labuan Bajo Airport');
    $item->load(['slot', 'cart.user']);

    $this->cartService->updateItem($item, 3);
})->throws(ValidationException::class);

it('can remove item from cart', function () {
    $cart = $this->cartService->addItem($this->customer, $this->slot, 2);
    $item = $cart->items->first();

    $this->cartService->removeItem($item);

    expect(CartItem::where('id', $item->id)->exists())->toBeFalse();
});

it('can clear cart', function () {
    $this->cartService->addItem($this->customer, $this->slot, 2);
    $cart = $this->cartService->getOrCreateCart($this->customer);

    $this->cartService->clearCart($cart);

    expect($cart->items()->count())->toBe(0);
});

it('calculates subtotal correctly', function () {
    $this->cartService->addItem($this->customer, $this->slot, 3);
    $cart = $this->cartService->getOrCreateCart($this->customer);

    $subtotal = $this->cartService->calculateSubtotal($cart);

    expect($subtotal)->toBe(1500000.0);
});

// ─── Cart Controller Tests ──────────────────────────────────────

it('guest cannot access cart page', function () {
    $this->get(route('cart.index'))->assertRedirect(route('login'));
});

it('customer can view cart', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('cart.index'))
        ->assertOk();
});

it('customer can add item to cart via controller', function () {
    $this->actingAs($this->customer)
        ->from(route('tours.show', $this->package->slug))
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 2,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('tours.show', $this->package->slug));

    $cart = Cart::where('user_id', $this->customer->id)->first();
    expect($cart->items)->toHaveCount(1);
});

it('customer can add item to cart via AJAX', function () {
    $this->actingAs($this->customer)
        ->postJson(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 2,
        ])
        ->assertOk()
        ->assertJsonStructure(['status', 'message', 'cartCount']);

    $cart = Cart::where('user_id', $this->customer->id)->first();
    expect($cart->items)->toHaveCount(1);
});

it('customer can add item and redirect directly to checkout', function () {
    $response = $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 2,
            'pickup_point' => 'Labuan Bajo Airport',
            'redirect_to' => 'checkout',
        ]);

    $cartItem = Cart::where('user_id', $this->customer->id)->firstOrFail()
        ->items()
        ->where('tour_departure_slot_id', $this->slot->id)
        ->where('pickup_point', 'Labuan Bajo Airport')
        ->firstOrFail();

    $response->assertRedirect(route('checkout.create', ['ids' => [$cartItem->id]]));
});

it('customer can remove item from cart via controller', function () {
    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 1,
        ]);

    $cartItem = Cart::where('user_id', $this->customer->id)->first()->items->first();

    $this->actingAs($this->customer)
        ->delete(route('cart.items.destroy', $cartItem))
        ->assertRedirect();
});

it('customer can clear entire cart', function () {
    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 1,
        ]);

    $this->actingAs($this->customer)
        ->delete(route('cart.clear'))
        ->assertRedirect();

    $cart = Cart::where('user_id', $this->customer->id)->first();
    expect($cart->items()->count())->toBe(0);
});

it('customer cannot manipulate another user cart item', function () {
    $otherCustomer = User::factory()->customer()->create();
    $cart = Cart::factory()->create(['user_id' => $otherCustomer->id]);
    $cartItem = $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $this->slot->id,
        'quantity' => 1,
        'price_per_person' => 500000,
        'line_total' => 500000,
    ]);

    $this->actingAs($this->customer)
        ->delete(route('cart.items.destroy', $cartItem))
        ->assertNotFound();
});

it('pickup_point is required when tour package has pickup points', function () {
    $this->package->pickupPoints()->create(['location_name' => 'Labuan Bajo Airport', 'order' => 1]);

    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 1,
        ])
        ->assertSessionHasErrors('pickup_point');
});

it('pickup_point is not required when tour package has no pickup points and is from vendor', function () {
    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 1,
        ])
        ->assertSessionHasNoErrors();
});

it('pickup_point is required when tour package is from admin even without predefined points', function () {
    $admin = User::factory()->admin()->create();
    $adminPackage = TourPackage::factory()->create([
        'vendor_id' => $admin->id,
        'status' => PackageStatus::Published,
    ]);
    $adminSlot = TourDepartureSlot::factory()->create(['tour_package_id' => $adminPackage->id]);

    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $adminSlot->id,
            'quantity' => 1,
        ])
        ->assertSessionHasErrors('pickup_point');
});

it('pickup_point passes validation when tour has pickup points and a value is provided', function () {
    $this->package->pickupPoints()->create(['location_name' => 'Labuan Bajo Airport', 'order' => 1]);

    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $this->slot->id,
            'quantity' => 1,
            'pickup_point' => 'Labuan Bajo Airport',
        ])
        ->assertSessionHasNoErrors();
});

it('pickup_point passes validation for admin package when a custom text is provided', function () {
    $admin = User::factory()->admin()->create();
    $adminPackage = TourPackage::factory()->create([
        'vendor_id' => $admin->id,
        'status' => PackageStatus::Published,
    ]);
    $adminSlot = TourDepartureSlot::factory()->create(['tour_package_id' => $adminPackage->id]);

    $this->actingAs($this->customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $adminSlot->id,
            'quantity' => 1,
            'pickup_point' => 'Any location at Labuan Bajo',
        ])
        ->assertSessionHasNoErrors();
});
