<?php

namespace Database\Factories;

use App\Enums\VendorStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VendorProfile>
 */
class VendorProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->vendor(),
            'status' => VendorStatus::Pending,
            'business_name' => fake()->company(),
            'business_description' => fake()->paragraph(),
            'address' => fake()->address(),
            'bank_name' => fake()->company(),
            'bank_account_name' => fake()->name(),
            'bank_account_number' => fake()->bankAccountNumber(),
            'approved_at' => null,
            'approved_by_user_id' => null,
            'rejected_reason' => null,
        ];
    }

    public function approved(?User $approvedBy = null): static
    {
        return $this->state(fn(): array => [
            'status' => VendorStatus::Approved,
            'approved_at' => now(),
            'approved_by_user_id' => $approvedBy?->id,
            'rejected_reason' => null,
        ]);
    }

    public function rejected(?User $approvedBy = null): static
    {
        return $this->state(fn(): array => [
            'status' => VendorStatus::Rejected,
            'approved_at' => null,
            'approved_by_user_id' => $approvedBy?->id,
            'rejected_reason' => fake()->sentence(),
        ]);
    }
}
