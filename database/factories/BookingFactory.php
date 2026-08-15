<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\OrderItem;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_item_id' => OrderItem::factory(),
            'user_id' => User::factory()->customer(),
            'vendor_id' => User::factory()->vendor(),
            'tour_package_id' => TourPackage::factory(),
            'status' => BookingStatus::Pending,
            'confirmed_at' => null,
            'completed_at' => null,
            'cancelled_at' => null,
            'cancellation_reason' => null,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BookingStatus::Completed,
            'completed_at' => now(),
        ]);
    }
}
