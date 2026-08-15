<?php

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('vendor can view profile edit page', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    $vendorProfile = VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Approved,
    ]);

    $response = $this->actingAs($user)->get(route('vendor.profile.edit'));

    $response->assertOk();
    $response->assertViewIs('vendor.profile.edit');
    $response->assertViewHas('user', $user);
    $response->assertViewHas('vendorProfile', $vendorProfile);
});

test('vendor can update profile without avatar', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    $vendorProfile = VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Approved,
    ]);

    $data = [
        'name' => 'Updated Name',
        'phone' => '+62812345678',
        'business_name' => 'Updated Business',
        'business_description' => 'Updated business description',
    ];

    $response = $this->actingAs($user)->put(route('vendor.profile.update'), $data);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Profil vendor berhasil diperbarui.');

    $user->refresh();
    $vendorProfile->refresh();

    expect($user->name)->toBe('Updated Name');
    expect($user->phone)->toBe('+62812345678');
    expect($vendorProfile->business_name)->toBe('Updated Business');
    expect($vendorProfile->business_description)->toBe('Updated business description');
});

test('vendor can update profile with avatar', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    $vendorProfile = VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Approved,
    ]);

    $avatar = UploadedFile::fake()->image('avatar.jpg');

    $data = [
        'name' => 'Updated Name',
        'phone' => '+62812345678',
        'business_name' => 'Updated Business',
        'business_description' => 'Updated business description',
        'avatar' => $avatar,
    ];

    $response = $this->actingAs($user)->put(route('vendor.profile.update'), $data);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Profil vendor berhasil diperbarui.');

    $user->refresh();
    expect($user->avatar)->not()->toBeNull();
    Storage::disk('public')->assertExists($user->avatar);
});

test('vendor profile update validates required fields', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Approved,
    ]);

    $response = $this->actingAs($user)->put(route('vendor.profile.update'), []);

    $response->assertSessionHasErrors([
        'name',
        'phone',
        'business_name',
        'business_description',
    ]);
});

test('vendor profile update validates avatar file type', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Approved,
    ]);

    $invalidFile = UploadedFile::fake()->create('document.pdf', 1000);

    $data = [
        'name' => 'Test Name',
        'phone' => '+62812345678',
        'business_name' => 'Test Business',
        'business_description' => 'Test description',
        'avatar' => $invalidFile,
    ];

    $response = $this->actingAs($user)->put(route('vendor.profile.update'), $data);

    $response->assertSessionHasErrors(['avatar']);
});

test('non-vendor cannot access profile edit', function () {
    $user = User::factory()->create(['role' => UserRole::Customer]);

    $response = $this->actingAs($user)->get(route('vendor.profile.edit'));

    $response->assertForbidden();
});

test('unauthenticated user cannot access profile edit', function () {
    $response = $this->get(route('vendor.profile.edit'));

    $response->assertRedirect(route('login'));
});

test('approved vendor is redirected from pending page to dashboard', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Approved,
    ]);

    $response = $this->actingAs($user)->get(route('vendor.pending'));

    $response->assertRedirect(route('vendor.dashboard'));
});

test('pending vendor can view pending page', function () {
    $user = User::factory()->create(['role' => UserRole::Vendor]);
    VendorProfile::factory()->create([
        'user_id' => $user->id,
        'status' => VendorStatus::Pending,
    ]);

    $response = $this->actingAs($user)->get(route('vendor.pending'));

    $response->assertOk();
    $response->assertViewIs('vendor.pending');
});
