<?php

use App\Models\User;
use App\Models\VendorProfile;

// ─── Vendor Dashboard ───────────────────────────────────────────

it('approved vendor can access vendor dashboard', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $this->actingAs($vendor)
        ->get(route('vendor.dashboard'))
        ->assertOk();
});

it('pending vendor is redirected to pending page', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->create(['user_id' => $vendor->id]); // default: pending

    $this->actingAs($vendor)
        ->get(route('vendor.dashboard'))
        ->assertRedirect(route('vendor.pending'));
});

it('customer cannot access vendor dashboard', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('vendor.dashboard'))
        ->assertForbidden();
});

// ─── Vendor Profile ─────────────────────────────────────────────

it('vendor can view pending page', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->create(['user_id' => $vendor->id]);

    $this->actingAs($vendor)
        ->get(route('vendor.pending'))
        ->assertOk();
});

it('vendor can view profile edit page', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $this->actingAs($vendor)
        ->get(route('vendor.profile.edit'))
        ->assertOk();
});

// ─── Vendor Reports ─────────────────────────────────────────────

it('approved vendor can access sales reports', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $this->actingAs($vendor)
        ->get(route('vendor.reports.sales'))
        ->assertOk();
});

it('pending vendor cannot access sales reports', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->create(['user_id' => $vendor->id]);

    $this->actingAs($vendor)
        ->get(route('vendor.reports.sales'))
        ->assertRedirect(route('vendor.pending'));
});
