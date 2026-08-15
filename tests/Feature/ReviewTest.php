<?php

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->customer()->create(['luxe_points' => 0]);
});

test('user can submit a review for a completed booking and gain luxe points', function () {
    $booking = Booking::factory()->completed()->create([
        'user_id' => $this->user->id,
    ]);

    $response = $this->actingAs($this->user)
        ->from(route('bookings.index'))
        ->post(route('bookings.reviews.store', $booking), [
            'rating' => 5,
            'comment' => 'Great experience!',
        ]);

    $response->assertRedirect(route('bookings.index'));
    $response->assertSessionHas('status');

    $this->assertDatabaseHas('reviews', [
        'booking_id' => $booking->id,
        'user_id' => $this->user->id,
        'rating' => 5,
        'comment' => 'Great experience!',
    ]);

    $this->user->refresh();
    expect($this->user->luxe_points)->toBe(50);
});

test('user cannot submit a review for another users booking', function () {
    $otherUser = User::factory()->customer()->create();
    $booking = Booking::factory()->completed()->create([
        'user_id' => $otherUser->id,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('bookings.reviews.store', $booking), [
            'rating' => 5,
            'comment' => 'Should not work',
        ]);

    $response->assertStatus(403);
});

test('user cannot submit a review for a non-completed booking', function () {
    $booking = Booking::factory()->create([
        'user_id' => $this->user->id,
        'status' => BookingStatus::Confirmed,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('bookings.reviews.store', $booking), [
            'rating' => 5,
            'comment' => 'Should not work',
        ]);

    $response->assertStatus(403);
});

test('user cannot submit multiple reviews for the same booking', function () {
    $booking = Booking::factory()->completed()->create([
        'user_id' => $this->user->id,
    ]);

    // First review
    Review::factory()->create([
        'booking_id' => $booking->id,
        'user_id' => $this->user->id,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('bookings.reviews.store', $booking), [
            'rating' => 4,
            'comment' => 'Second attempt',
        ]);

    $response->assertStatus(403);
});

test('review submission requires a rating', function () {
    $booking = Booking::factory()->completed()->create([
        'user_id' => $this->user->id,
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('bookings.reviews.store', $booking), [
            'comment' => 'Missing rating',
        ]);

    $response->assertSessionHasErrors(['rating']);
});
