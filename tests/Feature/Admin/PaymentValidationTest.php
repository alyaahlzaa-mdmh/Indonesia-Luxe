<?php

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentValidationStatus;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSubmission;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;

it('admin approval confirms order and bookings', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $category = TourCategory::factory()->create();
    $package = TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
    ]);
    $slot = TourDepartureSlot::factory()->create(['tour_package_id' => $package->id]);

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
    ]);

    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'tour_departure_slot_id' => $slot->id,
        'status' => BookingStatus::Pending,
    ]);

    $booking = Booking::factory()->create([
        'order_item_id' => $orderItem->id,
        'user_id' => $customer->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Pending,
    ]);

    $paymentSubmission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Pending,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.payments.update', $paymentSubmission), [
            'action' => 'approve',
        ])
        ->assertSessionHasNoErrors();

    expect($paymentSubmission->refresh()->status)->toBe(PaymentValidationStatus::Approved)
        ->and($order->refresh()->status)->toBe(OrderStatus::Paid)
        ->and($booking->refresh()->status)->toBe(BookingStatus::Confirmed);
});

it('admin reject payment keeps order pending payment', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();
    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
    ]);

    $paymentSubmission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Pending,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.payments.update', $paymentSubmission), [
            'action' => 'reject',
            'reason' => 'Bukti transfer tidak terbaca.',
        ])
        ->assertSessionHasNoErrors();

    expect($paymentSubmission->refresh()->status)->toBe(PaymentValidationStatus::Rejected)
        ->and($order->refresh()->status)->toBe(OrderStatus::PendingPayment);
});
