<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentValidationStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('customer can upload valid payment proof', function () {
    Storage::fake('public');

    $customer = User::factory()->customer()->create();

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::PendingPayment,
    ]);

    $this->actingAs($customer)
        ->post(route('payments.store', $order), [
            'proof' => UploadedFile::fake()->image('proof.png'),
            'bank_sender_name' => 'Test Customer',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($order->refresh()->status)->toBe(OrderStatus::AwaitingValidation)
        ->and($order->paymentSubmissions()->count())->toBe(1)
        ->and($order->paymentSubmissions()->first()->status)->toBe(PaymentValidationStatus::Pending);
});

it('customer cannot upload invalid payment proof file type', function () {
    $customer = User::factory()->customer()->create();
    $order = Order::factory()->create(['user_id' => $customer->id]);

    $this->actingAs($customer)
        ->from(route('payments.create', $order))
        ->post(route('payments.store', $order), [
            'proof' => UploadedFile::fake()->create('proof.txt', 12, 'text/plain'),
        ])
        ->assertSessionHasErrors(['proof'])
        ->assertRedirect(route('payments.create', $order));
});
