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
});

it('vendor submits package and admin approves it for public catalog', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved($admin)->create(['user_id' => $vendor->id]);

    $category = TourCategory::factory()->create();

    $this->actingAs($vendor)
        ->post(route('vendor.packages.store'), [
            'tour_category_id' => $category->id,
            'type' => PackageType::OpenTrip->value,
            'title' => 'Komodo Adventure',
            'description' => 'Paket open trip ke Komodo.',
            'meeting_point' => 'Labuan Bajo',
            'duration' => '3 hari 2 malam',
            'max_participants' => 12,
            'price_per_person' => 950000,
            'start_date' => now()->addDays(30)->format('Y-m-d'),
            'end_date' => now()->addDays(32)->format('Y-m-d'),
            'cover_image' => \Illuminate\Http\UploadedFile::fake()->image('cover.jpg'),
            'pickup_points' => ['Labuan Bajo Airport', 'Hotel Labuan Bajo'],
        ])
        ->assertSessionHasNoErrors();

    $tourPackage = TourPackage::query()->where('title', 'Komodo Adventure')->firstOrFail();

    expect($tourPackage->status)->toBe(PackageStatus::Draft);

    $this->actingAs($vendor)
        ->post(route('vendor.packages.submit', $tourPackage))
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($tourPackage->refresh()->status)->toBe(PackageStatus::PendingApproval);

    $this->actingAs($admin)
        ->patch(route('admin.packages.update', $tourPackage), [
            'action' => 'approve',
        ])
        ->assertSessionHasNoErrors();

    expect($tourPackage->refresh()->status)->toBe(PackageStatus::Published);

    $this->get(route('tours.index'))
        ->assertOk()
        ->assertSee('Komodo Adventure');
});

it('pending vendor cannot access package management routes', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->create(['user_id' => $vendor->id]);

    $this->actingAs($vendor)
        ->get(route('vendor.packages.index'))
        ->assertRedirect(route('vendor.pending'));
});
