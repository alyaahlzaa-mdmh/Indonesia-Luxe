<?php

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Enums\PaymentValidationStatus;
use App\Enums\VendorStatus;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSubmission;
use App\Models\Review;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourItinerary;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// ─── User Model ─────────────────────────────────────────────────

test('user has correct role helpers', function () {
    $customer = User::factory()->customer()->create();
    $vendor = User::factory()->vendor()->create();
    $admin = User::factory()->admin()->create();

    expect($customer->isCustomer())->toBeTrue()
        ->and($customer->isVendor())->toBeFalse()
        ->and($customer->isAdmin())->toBeFalse()
        ->and($vendor->isVendor())->toBeTrue()
        ->and($vendor->isCustomer())->toBeFalse()
        ->and($admin->isAdmin())->toBeTrue()
        ->and($admin->isCustomer())->toBeFalse();
});

test('user has initials from name', function () {
    $user = User::factory()->create(['name' => 'John']);
    expect($user->initials())->toBe('J');
});

test('user has avatar url', function () {
    $userWithAvatar = User::factory()->create(['avatar' => 'avatars/test.jpg']);
    $userWithoutAvatar = User::factory()->create(['avatar' => null]);

    expect($userWithAvatar->hasAvatar())->toBeTrue()
        ->and($userWithoutAvatar->hasAvatar())->toBeFalse()
        ->and($userWithAvatar->getAvatarUrl())->toContain('avatars/test.jpg')
        ->and($userWithoutAvatar->getAvatarUrl())->toContain('avatar.jpg');
});

test('user has vendor profile relationship', function () {
    $vendor = User::factory()->vendor()->create();
    $profile = VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    expect($vendor->vendorProfile->id)->toBe($profile->id);
});

test('user has tour packages relationship', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $package = TourPackage::factory()->create(['vendor_id' => $vendor->id]);

    expect($vendor->tourPackages)->toHaveCount(1)
        ->and($vendor->tourPackages->first()->id)->toBe($package->id);
});

test('user has cart relationship', function () {
    $customer = User::factory()->customer()->create();
    $cart = Cart::factory()->create(['user_id' => $customer->id]);

    expect($customer->cart->id)->toBe($cart->id);
});

test('user has orders relationship', function () {
    $customer = User::factory()->customer()->create();
    $order = Order::factory()->create(['user_id' => $customer->id]);

    expect($customer->orders)->toHaveCount(1)
        ->and($customer->orders->first()->id)->toBe($order->id);
});

test('user has bookings relationship', function () {
    $customer = User::factory()->customer()->create();
    $booking = Booking::factory()->create(['user_id' => $customer->id]);

    expect($customer->bookings)->toHaveCount(1)
        ->and($customer->bookings->first()->id)->toBe($booking->id);
});

test('user isVendorApproved returns correct result', function () {
    $vendorApproved = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendorApproved->id]);

    $vendorPending = User::factory()->vendor()->create();
    VendorProfile::factory()->create(['user_id' => $vendorPending->id]);

    $customer = User::factory()->customer()->create();

    expect($vendorApproved->isVendorApproved())->toBeTrue()
        ->and($vendorPending->isVendorApproved())->toBeFalse()
        ->and($customer->isVendorApproved())->toBeFalse();
});

// ─── TourPackage Model ──────────────────────────────────────────

test('tour package has vendor relationship', function () {
    $package = TourPackage::factory()->create();
    expect($package->vendor)->toBeInstanceOf(User::class);
});

test('tour package has category relationship', function () {
    $category = TourCategory::factory()->create();
    $package = TourPackage::factory()->create(['tour_category_id' => $category->id]);

    expect($package->category->id)->toBe($category->id);
});

test('tour package has slots relationship', function () {
    $package = TourPackage::factory()->create();
    TourDepartureSlot::factory()->count(3)->sequence(
        ['departure_date' => now()->addDays(1)->format('Y-m-d')],
        ['departure_date' => now()->addDays(2)->format('Y-m-d')],
        ['departure_date' => now()->addDays(3)->format('Y-m-d')],
    )->create(['tour_package_id' => $package->id]);

    expect($package->slots)->toHaveCount(3);
});

test('tour package has itineraries relationship', function () {
    $package = TourPackage::factory()->create();
    TourItinerary::create([
        'tour_package_id' => $package->id,
        'day_number' => 1,
        'time' => '08:00',
        'title' => 'Start Tour',
        'description' => 'Begin the adventure',
    ]);

    expect($package->itineraries)->toHaveCount(1);
});

test('tour package has reviews relationship', function () {
    $package = TourPackage::factory()->create();
    Review::factory()->create(['tour_package_id' => $package->id]);

    expect($package->reviews)->toHaveCount(1);
});

test('tour package has bookings relationship', function () {
    $package = TourPackage::factory()->create();
    Booking::factory()->create(['tour_package_id' => $package->id]);

    expect($package->bookings)->toHaveCount(1);
});

test('tour package published scope', function () {
    TourPackage::factory()->count(3)->create(['status' => PackageStatus::Published]);
    TourPackage::factory()->count(2)->create(['status' => PackageStatus::Draft]);

    expect(TourPackage::published()->count())->toBe(3);
});

test('tour package uses slug as route key', function () {
    $package = TourPackage::factory()->create();
    expect($package->getRouteKeyName())->toBe('slug');
});

// ─── TourDepartureSlot Model ────────────────────────────────────

test('tour departure slot available quota calculation', function () {
    $slot = TourDepartureSlot::factory()->create([
        'quota' => 10,
        'booked_count' => 3,
    ]);

    expect($slot->availableQuota())->toBe(7);
});

test('tour departure slot available quota never negative', function () {
    $slot = TourDepartureSlot::factory()->create([
        'quota' => 5,
        'booked_count' => 8,
    ]);

    expect($slot->availableQuota())->toBe(0);
});

test('tour departure slot has tour package relationship', function () {
    $package = TourPackage::factory()->create();
    $slot = TourDepartureSlot::factory()->create(['tour_package_id' => $package->id]);

    expect($slot->tourPackage->id)->toBe($package->id);
});

// ─── TourCategory Model ────────────────────────────────────────

test('tour category has packages relationship', function () {
    $category = TourCategory::factory()->create();
    TourPackage::factory()->count(2)->create(['tour_category_id' => $category->id]);

    expect($category->tourPackages)->toHaveCount(2);
});

// ─── Cart Model ─────────────────────────────────────────────────

test('cart has items relationship', function () {
    $cart = Cart::factory()->create();
    $package = TourPackage::factory()->create();
    $slot = TourDepartureSlot::factory()->create(['tour_package_id' => $package->id]);

    $cart->items()->create([
        'tour_package_id' => $package->id,
        'tour_departure_slot_id' => $slot->id,
        'quantity' => 2,
        'price_per_person' => 500000,
        'line_total' => 1000000,
    ]);

    expect($cart->items)->toHaveCount(1);
});

test('cart subtotal calculates correctly', function () {
    $cart = Cart::factory()->create();
    $package = TourPackage::factory()->create();
    $slot1 = TourDepartureSlot::factory()->create([
        'tour_package_id' => $package->id,
        'departure_date' => now()->addDays(1)->format('Y-m-d'),
    ]);
    $slot2 = TourDepartureSlot::factory()->create([
        'tour_package_id' => $package->id,
        'departure_date' => now()->addDays(2)->format('Y-m-d'),
    ]);

    $cart->items()->create([
        'tour_package_id' => $package->id,
        'tour_departure_slot_id' => $slot1->id,
        'quantity' => 2,
        'price_per_person' => 500000,
        'line_total' => 1000000,
    ]);

    $cart->items()->create([
        'tour_package_id' => $package->id,
        'tour_departure_slot_id' => $slot2->id,
        'quantity' => 1,
        'price_per_person' => 300000,
        'line_total' => 300000,
    ]);

    expect($cart->subtotal())->toBe(1300000.0);
});

// ─── Order Model ────────────────────────────────────────────────

test('order has user relationship', function () {
    $customer = User::factory()->customer()->create();
    $order = Order::factory()->create(['user_id' => $customer->id]);

    expect($order->user->id)->toBe($customer->id);
});

test('order has items relationship', function () {
    $order = Order::factory()->create();
    OrderItem::factory()->count(2)->create(['order_id' => $order->id]);

    expect($order->items)->toHaveCount(2);
});

test('order has payment submissions relationship', function () {
    $order = Order::factory()->create();
    PaymentSubmission::factory()->create(['order_id' => $order->id]);

    expect($order->paymentSubmissions)->toHaveCount(1);
});

// ─── Booking Model ──────────────────────────────────────────────

test('booking has all relationships', function () {
    $booking = Booking::factory()->create();

    expect($booking->user)->toBeInstanceOf(User::class)
        ->and($booking->vendor)->toBeInstanceOf(User::class)
        ->and($booking->tourPackage)->toBeInstanceOf(TourPackage::class)
        ->and($booking->orderItem)->toBeInstanceOf(OrderItem::class);
});

// ─── Review Model ───────────────────────────────────────────────

test('review has all relationships', function () {
    $review = Review::factory()->create();

    expect($review->user)->toBeInstanceOf(User::class)
        ->and($review->booking)->toBeInstanceOf(Booking::class)
        ->and($review->tourPackage)->toBeInstanceOf(TourPackage::class);
});

// ─── VendorProfile Model ───────────────────────────────────────

test('vendor profile has user relationship', function () {
    $vendor = User::factory()->vendor()->create();
    $profile = VendorProfile::factory()->create(['user_id' => $vendor->id]);

    expect($profile->user->id)->toBe($vendor->id);
});

test('vendor profile approved factory state', function () {
    $profile = VendorProfile::factory()->approved()->create();

    expect($profile->status)->toBe(VendorStatus::Approved)
        ->and($profile->approved_at)->not->toBeNull();
});

test('vendor profile rejected factory state', function () {
    $profile = VendorProfile::factory()->rejected()->create();

    expect($profile->status)->toBe(VendorStatus::Rejected)
        ->and($profile->rejected_reason)->not->toBeNull();
});

// ─── Enum Tests ─────────────────────────────────────────────────

test('package type enum has correct labels', function () {
    expect(PackageType::OpenTrip->label())->toBe('Open Trip')
        ->and(PackageType::PrivateTour->label())->toBe('Private Tour')
        ->and(PackageType::HikingCamping->label())->toBe('Hiking / Camping')
        ->and(PackageType::Rafting->label())->toBe('Rafting')
        ->and(PackageType::SnorkelingDiving->label())->toBe('Snorkeling / Diving')
        ->and(PackageType::JeepAdventure->label())->toBe('Jeep Adventure')
        ->and(PackageType::LocalExperience->label())->toBe('Local Experience');
});

test('order status enum has labels and colors', function () {
    foreach (OrderStatus::cases() as $status) {
        expect($status->label())->toBeString()
            ->and($status->color())->toBeString();
    }
});

test('booking status enum has labels and colors', function () {
    foreach (BookingStatus::cases() as $status) {
        expect($status->label())->toBeString()
            ->and($status->color())->toBeString();
    }
});

test('payment validation status enum has colors', function () {
    foreach (PaymentValidationStatus::cases() as $status) {
        expect($status->color())->toBeString();
    }
});
