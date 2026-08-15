<?php

use App\Models\User;
use App\Models\Cart;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\TourCategory;
use App\Models\VendorProfile;
use App\Enums\PackageStatus;
use App\Enums\PackageType;

it('redirects to cart if checkout is accessed with an empty cart', function () {
  $customer = User::factory()->customer()->create();

  $this->actingAs($customer)
    ->get(route('checkout.create'))
    ->assertRedirect(route('cart.index'))
    ->assertSessionHas('status', 'Silakan pilih minimal 1 item untuk checkout.');
});

it('redirects to cart if checkout is accessed with invalid item ids', function () {
  $customer = User::factory()->customer()->create();

  // Setup valid relations
  $vendor = User::factory()->vendor()->create();
  VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
  $category = TourCategory::factory()->create();
  $package = TourPackage::factory()->create(['vendor_id' => $vendor->id, 'tour_category_id' => $category->id]);
  $slot = TourDepartureSlot::factory()->create(['tour_package_id' => $package->id]);

  // Create cart with 1 item but try to checkout with a different ID
  $cart = Cart::factory()->create(['user_id' => $customer->id]);
  $cart->items()->create([
    'tour_package_id' => $package->id,
    'tour_departure_slot_id' => $slot->id,
    'quantity' => 1,
    'price_per_person' => 1000,
    'line_total' => 1000,
  ]);

  $this->actingAs($customer)
    ->get(route('checkout.create', ['ids' => [999]])) // ID 999 doesn't exist
    ->assertRedirect(route('cart.index'))
    ->assertSessionHas('status', 'Silakan pilih minimal 1 item untuk checkout.');
});

it('allows access to checkout if cart is not empty', function () {
  $customer = User::factory()->customer()->create();

  // Setup valid data
  $vendor = User::factory()->vendor()->create();
  VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
  $category = TourCategory::factory()->create();
  $package = TourPackage::factory()->create(['vendor_id' => $vendor->id, 'tour_category_id' => $category->id, 'status' => PackageStatus::Published]);
  $slot = TourDepartureSlot::factory()->create(['tour_package_id' => $package->id, 'departure_date' => now()->addDays(1)]);

  $cart = Cart::factory()->create(['user_id' => $customer->id]);
  $item = $cart->items()->create([
    'tour_package_id' => $package->id,
    'tour_departure_slot_id' => $slot->id,
    'quantity' => 1,
    'price_per_person' => 1000,
    'line_total' => 1000,
  ]);

  $this->actingAs($customer)
    ->get(route('checkout.create', ['ids' => [$item->id]]))
    ->assertOk()
    ->assertViewIs('checkout.create')
    ->assertViewHas('cart')
    ->assertViewHas('selectedIds', [$item->id]);
});
