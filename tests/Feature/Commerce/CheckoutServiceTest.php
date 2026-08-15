<?php

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Order;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use App\Services\CheckoutService;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->customer = User::factory()->customer()->create();

    $this->vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $this->vendor->id]);

    $this->category = TourCategory::factory()->create();

    $this->package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
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

it('checkout creates order with correct data', function () {
    $cart = Cart::factory()->create(['user_id' => $this->customer->id]);
    $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $this->slot->id,
        'quantity' => 2,
        'price_per_person' => 500000,
        'line_total' => 1000000,
    ]);

    $checkoutService = app(CheckoutService::class);
    $order = $checkoutService->checkout($this->customer, 'Test notes');

    expect($order)->toBeInstanceOf(Order::class)
        ->and($order->user_id)->toBe($this->customer->id)
        ->and($order->status)->toBe(OrderStatus::PendingPayment)
        ->and((float) $order->total_amount)->toBe(1000000.0)
        ->and($order->notes)->toBe('Test notes')
        ->and($order->items)->toHaveCount(1);

    // Verify slot booked_count updated
    expect($this->slot->refresh()->booked_count)->toBe(2);

    // Verify booking created
    $orderItem = $order->items->first();
    expect($orderItem->booking)->not->toBeNull()
        ->and($orderItem->booking->status)->toBe(BookingStatus::Pending);

    // Verify cart cleared
    expect($cart->items()->count())->toBe(0);
});

it('checkout with selected item IDs only processes those items', function () {
    $slot2 = TourDepartureSlot::factory()->create([
        'tour_package_id' => $this->package->id,
        'start_time' => '10:00:00',
        'quota' => 10,
        'booked_count' => 0,
        'price_per_person' => 300000,
    ]);

    $cart = Cart::factory()->create(['user_id' => $this->customer->id]);
    $item1 = $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $this->slot->id,
        'quantity' => 1,
        'price_per_person' => 500000,
        'line_total' => 500000,
    ]);
    $item2 = $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $slot2->id,
        'quantity' => 1,
        'price_per_person' => 300000,
        'line_total' => 300000,
    ]);

    $checkoutService = app(CheckoutService::class);
    $order = $checkoutService->checkout($this->customer, null, [$item1->id]);

    expect($order->items)->toHaveCount(1)
        ->and((float) $order->total_amount)->toBe(500000.0);
});

it('checkout fails when package not published', function () {
    $this->package->update(['status' => PackageStatus::Draft]);

    $cart = Cart::factory()->create(['user_id' => $this->customer->id]);
    $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $this->slot->id,
        'quantity' => 1,
        'price_per_person' => 500000,
        'line_total' => 500000,
    ]);

    $checkoutService = app(CheckoutService::class);
    $checkoutService->checkout($this->customer);
})->throws(ValidationException::class);

it('checkout fails when quota insufficient', function () {
    $this->slot->update(['quota' => 2, 'booked_count' => 1]);

    $cart = Cart::factory()->create(['user_id' => $this->customer->id]);
    $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $this->slot->id,
        'quantity' => 5,
        'price_per_person' => 500000,
        'line_total' => 2500000,
    ]);

    $checkoutService = app(CheckoutService::class);
    $checkoutService->checkout($this->customer);
})->throws(ValidationException::class);

it('checkout fails on empty cart', function () {
    Cart::factory()->create(['user_id' => $this->customer->id]);

    $checkoutService = app(CheckoutService::class);
    $checkoutService->checkout($this->customer);
})->throws(ValidationException::class);

it('order code has correct format', function () {
    $cart = Cart::factory()->create(['user_id' => $this->customer->id]);
    $cart->items()->create([
        'tour_package_id' => $this->package->id,
        'tour_departure_slot_id' => $this->slot->id,
        'quantity' => 1,
        'price_per_person' => 500000,
        'line_total' => 500000,
    ]);

    $checkoutService = app(CheckoutService::class);
    $order = $checkoutService->checkout($this->customer);

    expect($order->code)->toStartWith('ILX-');
});
