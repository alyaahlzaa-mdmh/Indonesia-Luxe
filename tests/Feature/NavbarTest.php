<?php

use App\Models\User;

test('admin sees admin dashboard entry in navbar', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->get(route('home'));

    $response
        ->assertOk()
        ->assertSee('data-test="mobile-profile-menu"', false)
        ->assertSee('Admin Dashboard')
        ->assertDontSee('Vendor Dashboard')
        ->assertDontSee('Booking Saya');
});

test('customer does not see admin dashboard entry in navbar', function () {
    $customer = User::factory()->customer()->create();

    $response = $this->actingAs($customer)->get(route('home'));

    $response
        ->assertOk()
        ->assertSee('data-test="mobile-profile-trigger"', false)
        ->assertSee('My Profile')
        ->assertSee(__('navbar.my_bookings'))
        ->assertDontSee('Admin Dashboard');
});

test('vendor does not see admin dashboard entry in navbar', function () {
    $vendor = User::factory()->vendor()->create();

    $response = $this->actingAs($vendor)->get(route('home'));

    $response
        ->assertOk()
        ->assertSee('data-test="mobile-profile-menu"', false)
        ->assertSee('Vendor Dashboard')
        ->assertSee(__('navbar.vendor_profile'))
        ->assertDontSee('Admin Dashboard');
});
