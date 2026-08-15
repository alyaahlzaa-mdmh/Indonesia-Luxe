<?php

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $this->vendor->id]);
    $this->category = TourCategory::factory()->create();
});

it('approved vendor can access package list', function () {
    $this->actingAs($this->vendor)
        ->get(route('vendor.packages.index'))
        ->assertOk();
});

it('approved vendor can access package create form', function () {
    $this->actingAs($this->vendor)
        ->get(route('vendor.packages.create'))
        ->assertOk();
});

it('approved vendor can create a tour package', function () {
    $this->actingAs($this->vendor)
        ->post(route('vendor.packages.store'), [
            'tour_category_id' => $this->category->id,
            'type' => PackageType::OpenTrip->value,
            'title' => 'Raja Ampat Diving',
            'description' => 'Amazing diving experience in Raja Ampat.',
            'meeting_point' => 'Sorong',
            'duration' => '4 hari 3 malam',
            'max_participants' => 8,
            'price_per_person' => 3500000,
            'start_date' => now()->addDays(60)->format('Y-m-d'),
            'end_date' => now()->addDays(63)->format('Y-m-d'),
            'cover_image' => \Illuminate\Http\UploadedFile::fake()->image('cover.jpg'),
            'pickup_points' => ['Sorong Airport', 'Hotel Sorong'],
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $package = TourPackage::where('title', 'Raja Ampat Diving')->first();

    expect($package)->not->toBeNull()
        ->and($package->status)->toBe(PackageStatus::Draft)
        ->and($package->vendor_id)->toBe($this->vendor->id)
        ->and($package->slug)->toContain('raja-ampat-diving');
});

it('vendor can edit their own package', function () {
    $package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
        'status' => PackageStatus::Draft,
    ]);

    $this->actingAs($this->vendor)
        ->get(route('vendor.packages.edit', $package))
        ->assertOk();
});

it('vendor can update their own package', function () {
    $package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
        'status' => PackageStatus::Draft,
        'title' => 'Old Title',
    ]);

    $this->actingAs($this->vendor)
        ->put(route('vendor.packages.update', $package), [
            'tour_category_id' => $this->category->id,
            'type' => PackageType::OpenTrip->value,
            'title' => 'Updated Title',
            'description' => 'Updated description.',
            'price_per_person' => 2000000,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($package->refresh()->title)->toBe('Updated Title');
});

it('updating rejected package resets status to draft', function () {
    $package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
        'status' => PackageStatus::Rejected,
        'rejected_reason' => 'Fix description.',
    ]);

    $this->actingAs($this->vendor)
        ->put(route('vendor.packages.update', $package), [
            'tour_category_id' => $this->category->id,
            'type' => PackageType::OpenTrip->value,
            'title' => $package->title,
            'description' => 'Updated description with fix.',
            'price_per_person' => 2000000,
        ])
        ->assertSessionHasNoErrors();

    expect($package->refresh()->status)->toBe(PackageStatus::Draft)
        ->and($package->rejected_reason)->toBeNull();
});

it('vendor can delete their own package', function () {
    $package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
    ]);

    $this->actingAs($this->vendor)
        ->delete(route('vendor.packages.destroy', $package))
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('vendor.packages.index'));

    expect(TourPackage::find($package->id))->toBeNull();
});

it('vendor cannot edit another vendor package', function () {
    $otherVendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $otherVendor->id]);

    $package = TourPackage::factory()->create([
        'vendor_id' => $otherVendor->id,
        'tour_category_id' => $this->category->id,
    ]);

    $this->actingAs($this->vendor)
        ->get(route('vendor.packages.edit', $package))
        ->assertForbidden();
});

it('vendor cannot delete another vendor package', function () {
    $otherVendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $otherVendor->id]);

    $package = TourPackage::factory()->create([
        'vendor_id' => $otherVendor->id,
        'tour_category_id' => $this->category->id,
    ]);

    $this->actingAs($this->vendor)
        ->delete(route('vendor.packages.destroy', $package))
        ->assertForbidden();
});

it('vendor can submit package for approval', function () {
    $package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
        'status' => PackageStatus::Draft,
    ]);

    $this->actingAs($this->vendor)
        ->post(route('vendor.packages.submit', $package))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($package->refresh()->status)->toBe(PackageStatus::PendingApproval);
});

it('customer cannot access vendor package management', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('vendor.packages.index'))
        ->assertForbidden();
});
