<?php

use App\Enums\PackageStatus;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;

beforeEach(function () {
    $this->vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $this->vendor->id]);

    $this->category = TourCategory::factory()->create();

    $this->package = TourPackage::factory()->create([
        'vendor_id' => $this->vendor->id,
        'tour_category_id' => $this->category->id,
        'status' => PackageStatus::Draft,
    ]);
});

it('vendor can add departure slot to their package', function () {
    $this->actingAs($this->vendor)
        ->post(route('vendor.slots.store', $this->package), [
            'departure_date' => now()->addDays(10)->format('Y-m-d'),
            'start_time' => '08:00',
            'end_time' => '17:00',
            'quota' => 15,
            'price_per_person' => 500000,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($this->package->slots()->count())->toBe(1);
});

it('vendor can update departure slot', function () {
    $slot = TourDepartureSlot::factory()->create([
        'tour_package_id' => $this->package->id,
        'quota' => 10,
    ]);

    $this->actingAs($this->vendor)
        ->patch(route('vendor.slots.update', $slot), [
            'departure_date' => now()->addDays(20)->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '18:00',
            'quota' => 25,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($slot->refresh()->quota)->toBe(25);
});

it('vendor can delete departure slot', function () {
    $slot = TourDepartureSlot::factory()->create([
        'tour_package_id' => $this->package->id,
    ]);

    $this->actingAs($this->vendor)
        ->delete(route('vendor.slots.destroy', $slot))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect(TourDepartureSlot::find($slot->id))->toBeNull();
});

it('vendor cannot manage slots of another vendor package', function () {
    $otherVendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $otherVendor->id]);

    $otherPackage = TourPackage::factory()->create([
        'vendor_id' => $otherVendor->id,
        'tour_category_id' => $this->category->id,
    ]);

    $this->actingAs($this->vendor)
        ->post(route('vendor.slots.store', $otherPackage), [
            'departure_date' => now()->addDays(10)->format('Y-m-d'),
            'start_time' => '08:00',
            'end_time' => '17:00',
            'quota' => 15,
        ])
        ->assertForbidden();
});

it('vendor cannot delete slot of another vendor package', function () {
    $otherVendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $otherVendor->id]);

    $otherPackage = TourPackage::factory()->create([
        'vendor_id' => $otherVendor->id,
        'tour_category_id' => $this->category->id,
    ]);

    $slot = TourDepartureSlot::factory()->create([
        'tour_package_id' => $otherPackage->id,
    ]);

    $this->actingAs($this->vendor)
        ->delete(route('vendor.slots.destroy', $slot))
        ->assertForbidden();
});
