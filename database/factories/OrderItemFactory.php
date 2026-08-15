<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\Order;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 3);
        $price = fake()->randomFloat(2, 150000, 5000000);

        return [
            'order_id' => Order::factory(),
            'vendor_id' => User::factory()->vendor(),
            'tour_package_id' => TourPackage::factory(),
            'tour_departure_slot_id' => TourDepartureSlot::factory(),
            'package_title' => fake()->sentence(3),
            'departure_date' => fake()->dateTimeBetween('+1 day', '+90 days')->format('Y-m-d'),
            'quantity' => $quantity,
            'price_per_person' => $price,
            'line_total' => $price * $quantity,
            'status' => BookingStatus::Pending,
        ];
    }
}
