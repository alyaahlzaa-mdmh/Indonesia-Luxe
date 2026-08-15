<?php

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Livewire\Checkout;
use App\Models\Cart;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
  Storage::fake('public');
});

it('can process checkout from step 1 to step 3', function () {
  $customer = User::factory()->customer()->create([
    'name'  => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '08123456789',
  ]);

  $vendor = User::factory()->vendor()->create();
  VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

  $category = TourCategory::factory()->create(['name' => 'Adventure']);

  $package = TourPackage::factory()->create([
    'vendor_id'        => $vendor->id,
    'tour_category_id' => $category->id,
    'status'          => PackageStatus::Published,
    'type'            => PackageType::OpenTrip,
    'price_per_person' => 500000,
    'title'           => 'Bromo Adventure',
  ]);

  $slot = TourDepartureSlot::factory()->create([
    'tour_package_id' => $package->id,
    'quota'          => 10,
    'booked_count'   => 0,
    'price_per_person' => 500000,
    'departure_date'     => now()->addDays(7),
  ]);

  // Add to cart
  $cart = Cart::factory()->create(['user_id' => $customer->id]);
  $cartItem = $cart->items()->create([
    'tour_package_id'        => $package->id,
    'tour_departure_slot_id' => $slot->id,
    'quantity'              => 2,
    'price_per_person'      => 500000,
    'line_total'            => 1000000,
  ]);

  $this->actingAs($customer);

  Livewire::test(Checkout::class, [
    'cartItems'   => collect([$cartItem]),
    'selectedIds' => [$cartItem->id],
  ])
    // Step 1: Check initial data
    ->assertSet('step', 1)
    ->assertSet('name', 'John Doe')
    ->assertSet('email', 'john@example.com')
    ->assertSet('phone', '8123456789') // formattedPhone strips leading 0
    ->assertSet('subtotal', 1000000)

    // Step 1: Validation failure (empty name)
    ->set('name', '')
    ->call('nextStep')
    ->assertHasErrors(['name' => 'required'])
    ->assertSet('step', 1)

    // Step 1: Valid data & move to Step 2
    ->set('name', 'John Doe Updated')
    ->call('nextStep')
    ->assertHasNoErrors()
    ->assertSet('step', 2)

    // Step 2: Check summary data
    ->assertSee('John Doe Updated')
    ->assertSee('john@example.com')

    // Optional: Upload proof
    ->set('proof', UploadedFile::fake()->image('proof.jpg'))

    // Step 2: Submit Booking
    ->call('submitBooking')
    ->assertHasNoErrors()
    ->assertSet('step', 3)
    ->assertDispatched('toast')
    ->assertDispatched('open-whatsapp');

  // Assert database state
  $this->assertDatabaseHas('orders', [
    'user_id'      => $customer->id,
    'total_amount' => 1000000,
  ]);

  // Assert cart is cleared
  expect($cart->items()->count())->toBe(0);
});

it('strips leading 0 and 62 from phone during mount', function () {
  $customer = User::factory()->customer()->create(['phone' => '628123456789']);
  $cartItem = collect(); // Empty for this test

  $this->actingAs($customer);
  Livewire::test(Checkout::class, ['cartItems' => $cartItem])
    ->assertSet('phone', '8123456789');

  $customer2 = User::factory()->customer()->create(['phone' => '0899887766']);
  $this->actingAs($customer2);
  Livewire::test(Checkout::class, ['cartItems' => $cartItem])
    ->assertSet('phone', '899887766');
});
