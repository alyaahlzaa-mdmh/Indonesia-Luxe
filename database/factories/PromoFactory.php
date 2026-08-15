<?php

namespace Database\Factories;

use App\Enums\PromoDiscountType;
use App\Enums\PromoStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promo>
 */
class PromoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor_id' => User::factory()->vendor(),
            'code' => strtoupper(fake()->unique()->bothify('LUXE####')),
            'description' => fake()->sentence(),
            'group' => fake()->randomElement(['Flash Sale', 'Weekend Deal', 'Indonesia Luxe']),
            'discount_type' => fake()->randomElement([
                PromoDiscountType::Percent,
                PromoDiscountType::Flat,
            ]),
            'discount_value' => fake()->numberBetween(10, 500000),
            'min_purchase' => fake()->numberBetween(0, 1000000),
            'category_restriction' => fake()->optional()->randomElement(['Adventure', 'Culture', 'Nature']),
            'valid_from' => now()->toDateString(),
            'valid_until' => now()->addMonth()->toDateString(),
            'is_active' => true,
            'status' => PromoStatus::PendingApproval,
            'rejected_reason' => null,
        ];
    }

    public function internal(): static
    {
        return $this->state(fn (): array => [
            'vendor_id' => User::factory()->admin(),
        ]);
    }

    public function pendingApproval(): static
    {
        return $this->state(fn (): array => [
            'status' => PromoStatus::PendingApproval,
            'is_active' => false,
            'rejected_reason' => null,
        ]);
    }

    public function active(): static
    {
        return $this->state(fn (): array => [
            'status' => PromoStatus::Active,
            'is_active' => true,
            'rejected_reason' => null,
        ]);
    }

    public function rejected(string $reason = 'Tidak memenuhi kriteria promosi.'): static
    {
        return $this->state(fn (): array => [
            'status' => PromoStatus::Rejected,
            'is_active' => false,
            'rejected_reason' => $reason,
        ]);
    }
}
