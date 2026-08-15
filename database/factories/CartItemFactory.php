<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\TourDepartureSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'tour_package_id' => \App\Models\TourPackage::factory(),
            'tour_departure_slot_id' => TourDepartureSlot::factory(),
            'quantity' => fake()->numberBetween(1, 4),
            'price_per_person' => fake()->randomFloat(2, 150000, 5000000),
            'line_total' => fake()->randomFloat(2, 150000, 5000000),
        ];
    }
}
