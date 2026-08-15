<?php

use App\Enums\PackageStatus;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;

it('home page returns successful response', function () {
    $response = $this->get(route('home'));
    $response->assertOk();
});

it('home page shows published packages', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Bromo Sunrise Adventure',
    ]);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Draft,
        'is_active' => true,
        'title' => 'Draft Package Hidden',
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Bromo Sunrise Adventure')
        ->assertDontSee('Draft Package Hidden');
});

it('home page displays tour cover images from storage', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Storage Bromo Tour',
        'cover_image_path' => 'tour-covers/bromo.jpg',
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('/storage/tour-covers/bromo.jpg', false);
});

it('tours index returns successful response', function () {
    $this->get(route('tours.index'))->assertOk();
});

it('tours index shows only published active packages', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Published Tour',
    ]);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Draft,
        'is_active' => true,
        'title' => 'Draft Tour',
    ]);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => false,
        'title' => 'Inactive Tour',
    ]);

    $this->get(route('tours.index'))
        ->assertOk()
        ->assertSee('Published Tour')
        ->assertDontSee('Draft Tour')
        ->assertDontSee('Inactive Tour');
});

it('tours index can search by title', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Komodo Adventure',
    ]);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Bali Beach Trip',
    ]);

    $this->get(route('tours.index', ['q' => 'Komodo']))
        ->assertOk()
        ->assertSee('Komodo Adventure')
        ->assertDontSee('Bali Beach Trip');
});

it('tours index can filter by category', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $adventure = TourCategory::factory()->create(['name' => 'Adventure', 'slug' => 'adventure']);
    $culture = TourCategory::factory()->create(['name' => 'Culture', 'slug' => 'culture']);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $adventure->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Adventure Tour',
    ]);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $culture->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'title' => 'Culture Tour',
    ]);

    $this->get(route('tours.index', ['category' => 'adventure']))
        ->assertOk()
        ->assertSee('Adventure Tour')
        ->assertDontSee('Culture Tour');
});

it('tours index can filter by type', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'type' => 'open_trip',
        'title' => 'Open Trip Package',
    ]);

    TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'is_active' => true,
        'type' => 'rafting',
        'title' => 'Rafting Package',
    ]);

    $this->get(route('tours.index', ['type' => 'open_trip']))
        ->assertOk()
        ->assertSee('Open Trip Package')
        ->assertDontSee('Rafting Package');
});

it('tours show displays published package', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    $package = TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'title' => 'Komodo Tour',
        'slug' => 'komodo-tour',
    ]);

    TourDepartureSlot::factory()->create([
        'tour_package_id' => $package->id,
        'departure_date' => now()->addDays(10),
    ]);

    $this->get(route('tours.show', $package))
        ->assertOk()
        ->assertSee('Komodo Tour');
});

it('customer sees a working checkout CTA on tour detail', function () {
    $customer = User::factory()->customer()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $category = TourCategory::factory()->create();

    $package = TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
        'status' => PackageStatus::Published,
        'title' => 'Komodo Tour',
        'slug' => 'komodo-tour-working-cta',
    ]);

    TourDepartureSlot::factory()->create([
        'tour_package_id' => $package->id,
        'departure_date' => now()->addDays(10),
    ]);

    $this->actingAs($customer)
        ->get(route('tours.show', $package))
        ->assertOk()
        ->assertSee('name="redirect_to"', false)
        ->assertSee('value="checkout"', false);
});

it('tours show returns 404 for non-published package', function () {
    $package = TourPackage::factory()->create([
        'status' => PackageStatus::Draft,
    ]);

    $this->get(route('tours.show', $package))
        ->assertNotFound();
});
