<?php

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\User;

it('guest can view vendor registration form', function () {
    $this->get(route('vendor.register'))->assertOk();
});

it('authenticated user cannot access vendor registration form', function () {
    $user = User::factory()->customer()->create();

    $this->actingAs($user)
        ->get(route('vendor.register'))
        ->assertRedirect();
});

it('guest can register as vendor', function () {
    $this->post(route('vendor.register.store'), [
        'name' => 'Test Vendor',
        'email' => 'vendor@test.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'business_name' => 'Test Business',
    ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('vendor.pending'));

    $vendor = User::where('email', 'vendor@test.com')->first();

    expect($vendor)->not->toBeNull()
        ->and($vendor->role)->toBe(UserRole::Vendor)
        ->and($vendor->vendorProfile)->not->toBeNull()
        ->and($vendor->vendorProfile->status)->toBe(VendorStatus::Pending)
        ->and($vendor->vendorProfile->business_name)->toBe('Test Business');
});

it('vendor registration requires valid data', function () {
    $this->post(route('vendor.register.store'), [
        'name' => '',
        'email' => 'invalid-email',
        'password' => 'short',
    ])
        ->assertSessionHasErrors(['name', 'email', 'password']);
});
