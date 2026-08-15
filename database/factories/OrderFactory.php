<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'ILX-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
            'user_id' => User::factory()->customer(),
            'status' => OrderStatus::PendingPayment,
            'total_amount' => fake()->randomFloat(2, 150000, 7000000),
            'payment_due_at' => now()->addDay(),
            'paid_at' => null,
            'notes' => null,
        ];
    }
}
