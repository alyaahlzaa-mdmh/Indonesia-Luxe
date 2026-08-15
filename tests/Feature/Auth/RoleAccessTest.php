<?php

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\User;
use App\Models\VendorProfile;

test('customer cannot access vendor and admin dashboards', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('vendor.dashboard'))
        ->assertForbidden();

    $this->actingAs($customer)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('pending vendor is redirected to pending page', function () {
    $vendor = User::factory()->vendor()->create();

    VendorProfile::factory()->create([
        'user_id' => $vendor->id,
        'status' => VendorStatus::Pending,
    ]);

    $this->actingAs($vendor)
        ->get(route('vendor.dashboard'))
        ->assertRedirect(route('vendor.pending'));
});

test('admin can access admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk();
});
