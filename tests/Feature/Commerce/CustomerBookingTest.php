<?php

use App\Models\Order;
use App\Models\User;

// ─── Customer Bookings ──────────────────────────────────────────

it('customer can view their bookings list', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('bookings.index'))
        ->assertOk();
});

it('customer can view their order details', function () {
    $customer = User::factory()->customer()->create();
    $order = Order::factory()->create(['user_id' => $customer->id]);

    $this->actingAs($customer)
        ->get(route('orders.show', $order))
        ->assertOk();
});

it('customer cannot view another customer order', function () {
    $customer = User::factory()->customer()->create();
    $otherCustomer = User::factory()->customer()->create();
    $order = Order::factory()->create(['user_id' => $otherCustomer->id]);

    $this->actingAs($customer)
        ->get(route('orders.show', $order))
        ->assertForbidden();
});

it('guest cannot access bookings page', function () {
    $this->get(route('bookings.index'))->assertRedirect(route('login'));
});

it('guest cannot access order details', function () {
    $order = Order::factory()->create();

    $this->get(route('orders.show', $order))->assertRedirect(route('login'));
});

// ─── Vendor Access ──────────────────────────────────────────────

it('vendor cannot access customer bookings page', function () {
    $vendor = User::factory()->vendor()->create();

    $this->actingAs($vendor)
        ->get(route('bookings.index'))
        ->assertForbidden();
});
