<?php

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Review;
use App\Models\TourPackage;
use App\Models\User;

it('customer cannot review incomplete booking', function () {
    $customer = User::factory()->customer()->create();

    $booking = Booking::factory()->create([
        'user_id' => $customer->id,
        'status' => BookingStatus::Pending,
        'tour_package_id' => TourPackage::factory()->create()->id,
    ]);

    $this->actingAs($customer)
        ->post(route('bookings.reviews.store', $booking), [
            'rating' => 5,
            'title' => 'Great',
            'comment' => 'Amazing trip',
        ])
        ->assertForbidden();
});

it('customer can review completed booking once', function () {
    $customer = User::factory()->customer()->create();

    $booking = Booking::factory()->create([
        'user_id' => $customer->id,
        'status' => BookingStatus::Completed,
        'tour_package_id' => TourPackage::factory()->create()->id,
    ]);

    $this->actingAs($customer)
        ->post(route('bookings.reviews.store', $booking), [
            'rating' => 5,
            'title' => 'Great',
            'comment' => 'Amazing trip',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect(Review::query()->where('booking_id', $booking->id)->count())->toBe(1);
});
