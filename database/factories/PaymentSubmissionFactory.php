<?php

namespace Database\Factories;

use App\Enums\PaymentValidationStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentSubmission>
 */
class PaymentSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'submitted_by_user_id' => User::factory()->customer(),
            'status' => PaymentValidationStatus::Pending,
            'proof_path' => 'payment-proofs/sample.png',
            'bank_sender_name' => fake()->name(),
            'bank_sender_account' => fake()->bankAccountNumber(),
            'notes' => null,
            'validated_by_user_id' => null,
            'validated_at' => null,
            'rejection_reason' => null,
        ];
    }
}
