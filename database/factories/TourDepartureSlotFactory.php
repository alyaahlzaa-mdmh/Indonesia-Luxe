<?php

namespace Database\Factories;

use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourDepartureSlot>
 */
class TourDepartureSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tour_package_id' => TourPackage::factory(),
            'departure_date' => fake()->dateTimeBetween('+3 days', '+90 days')->format('Y-m-d'),
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'quota' => fake()->numberBetween(5, 20),
            'booked_count' => 0,
            'price_per_person' => null,
        ];
    }
}
