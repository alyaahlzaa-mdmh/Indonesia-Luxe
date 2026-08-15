<?php

namespace Database\Factories;

use App\Enums\PromoStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GiftCard>
 */
class GiftCardFactory extends Factory
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
            'code' => 'GIFT-'.strtoupper(fake()->unique()->bothify('####??##')),
            'value' => fake()->numberBetween(10000, 500000),
            'expires_at' => now()->addMonth()->toDateString(),
            'max_usages' => fake()->numberBetween(1, 50),
            'used_count' => 0,
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

    public function rejected(string $reason = 'Kode gift card belum dapat disetujui.'): static
    {
        return $this->state(fn (): array => [
            'status' => PromoStatus::Rejected,
            'is_active' => false,
            'rejected_reason' => $reason,
        ]);
    }
}
