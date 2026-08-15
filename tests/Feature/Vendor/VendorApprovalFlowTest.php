<?php

use App\Enums\VendorStatus;
use App\Models\User;
use App\Models\VendorProfile;

it('admin can approve vendor profile', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();

    $vendorProfile = VendorProfile::factory()->create([
        'user_id' => $vendor->id,
        'status' => VendorStatus::Pending,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.vendors.update', $vendorProfile), [
            'action' => 'approve',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $vendorProfile->refresh();

    expect($vendorProfile->status)->toBe(VendorStatus::Approved)
        ->and($vendorProfile->approved_by_user_id)->toBe($admin->id);
});

it('admin can reject vendor profile with reason', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();

    $vendorProfile = VendorProfile::factory()->create([
        'user_id' => $vendor->id,
        'status' => VendorStatus::Pending,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.vendors.update', $vendorProfile), [
            'action' => 'reject',
            'reason' => 'Dokumen tidak valid.',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $vendorProfile->refresh();

    expect($vendorProfile->status)->toBe(VendorStatus::Rejected)
        ->and($vendorProfile->rejected_reason)->toBe('Dokumen tidak valid.');
});
