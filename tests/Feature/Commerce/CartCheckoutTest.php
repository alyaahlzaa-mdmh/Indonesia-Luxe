<?php

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Models\Cart;
use App\Models\Order;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;

it('customer can checkout multi booking across different vendors', function () {
    $customer = User::factory()->customer()->create();

    $vendorA = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendorA->id]);

    $vendorB = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendorB->id]);

    $category = TourCategory::factory()->create();

    $packageA = TourPackage::factory()->create([
        'vendor_id' => $vendorA->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'type' => PackageType::OpenTrip,
        'price_per_person' => 400000,
        'title' => 'Bromo Sunrise',
    ]);

    $slotA = TourDepartureSlot::factory()->create([
        'tour_package_id' => $packageA->id,
        'quota' => 20,
        'booked_count' => 0,
        'price_per_person' => 400000,
    ]);

    $packageB = TourPackage::factory()->create([
        'vendor_id' => $vendorB->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'type' => PackageType::Rafting,
        'price_per_person' => 600000,
        'title' => 'Ayung Rafting',
    ]);

    $slotB = TourDepartureSlot::factory()->create([
        'tour_package_id' => $packageB->id,
        'quota' => 20,
        'booked_count' => 0,
        'price_per_person' => 600000,
    ]);

    $this->actingAs($customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $slotA->id,
            'quantity' => 2,
        ])
        ->assertSessionHasNoErrors();

    $this->actingAs($customer)
        ->post(route('cart.items.store'), [
            'tour_departure_slot_id' => $slotB->id,
            'quantity' => 1,
        ])
        ->assertSessionHasNoErrors();

    $this->actingAs($customer)
        ->post(route('checkout.store'), [
            'notes' => 'Checkout test',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $order = Order::query()->where('user_id', $customer->id)->firstOrFail();

    expect($order->items()->count())->toBe(2)
        ->and($order->items->pluck('vendor_id')->unique()->count())->toBe(2)
        ->and($order->items->sum('quantity'))->toBe(3)
        ->and($order->items()->has('booking')->count())->toBe(2);

    expect(Cart::query()->where('user_id', $customer->id)->firstOrFail()->items()->count())->toBe(0);
});
