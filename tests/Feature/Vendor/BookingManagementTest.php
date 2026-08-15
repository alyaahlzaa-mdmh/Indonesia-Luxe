<?php

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;

it('vendor can view their bookings list', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $booking = Booking::factory()->create([
        'vendor_id' => $vendor->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $this->actingAs($vendor)
        ->get(route('vendor.bookings.index'))
        ->assertOk();
});

it('vendor can complete a confirmed booking', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $customer = User::factory()->customer()->create();
    $package = TourPackage::factory()->create(['vendor_id' => $vendor->id]);

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
    ]);

    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $booking = Booking::factory()->create([
        'order_item_id' => $orderItem->id,
        'user_id' => $customer->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $this->actingAs($vendor)
        ->patch(route('vendor.bookings.complete', $booking))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($booking->refresh()->status)->toBe(BookingStatus::Completed)
        ->and($booking->completed_at)->not->toBeNull()
        ->and($orderItem->refresh()->status)->toBe(BookingStatus::Completed);
});

it('vendor cannot complete a pending booking', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $booking = Booking::factory()->create([
        'vendor_id' => $vendor->id,
        'status' => BookingStatus::Pending,
    ]);

    $this->actingAs($vendor)
        ->patch(route('vendor.bookings.complete', $booking))
        ->assertSessionHasErrors('booking');
});

it('all items completed marks order as completed', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $customer = User::factory()->customer()->create();
    $package = TourPackage::factory()->create(['vendor_id' => $vendor->id]);

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
    ]);

    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $booking = Booking::factory()->create([
        'order_item_id' => $orderItem->id,
        'user_id' => $customer->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $this->actingAs($vendor)
        ->patch(route('vendor.bookings.complete', $booking))
        ->assertSessionHasNoErrors();

    expect($order->refresh()->status)->toBe(OrderStatus::Completed);
});

it('vendor cannot complete another vendor booking', function () {
    $vendorA = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendorA->id]);

    $vendorB = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendorB->id]);

    $booking = Booking::factory()->create([
        'vendor_id' => $vendorB->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $this->actingAs($vendorA)
        ->patch(route('vendor.bookings.complete', $booking))
        ->assertForbidden();
});
