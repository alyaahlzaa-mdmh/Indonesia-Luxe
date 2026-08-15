<?php

use App\Enums\UserRole;
use App\Livewire\Guest\HomePage;
use App\Models\TourPackage;
use App\Models\User;
use Livewire\Livewire;

test('guest cannot toggle wishlist', function () {
    $tour = TourPackage::factory()->create();

    Livewire::test(HomePage::class)
        ->call('toggleWishlist', $tour->id)
        ->assertDispatched('action-toast', message: 'Silakan login terlebih dahulu untuk menyimpan wishlist ❤️', status: 'guest');

    expect(auth()->user())->toBeNull();
});

test('customer can add tour to wishlist', function () {
    $user = User::factory()->create(['role' => UserRole::Customer]);
    $tour = TourPackage::factory()->create();

    Livewire::actingAs($user)
        ->test(HomePage::class)
        ->call('toggleWishlist', $tour->id)
        ->assertDispatched('action-toast', message: 'Ditambahkan ke wishlist ❤️', status: 'added');

    expect($user->wishlistedTourPackages()->where('tour_package_id', $tour->id)->exists())->toBeTrue();
});

test('customer can remove tour from wishlist via toggle', function () {
    $user = User::factory()->create(['role' => UserRole::Customer]);
    $tour = TourPackage::factory()->create();
    $user->wishlistedTourPackages()->attach($tour->id);

    Livewire::actingAs($user)
        ->test(HomePage::class)
        ->call('toggleWishlist', $tour->id)
        ->assertDispatched('action-toast', message: 'Dihapus dari wishlist 💔', status: 'removed');

    expect($user->wishlistedTourPackages()->where('tour_package_id', $tour->id)->exists())->toBeFalse();
});

test('wishlist index page shows favorited tours', function () {
    $user = User::factory()->create(['role' => UserRole::Customer]);
    $tours = TourPackage::factory()->count(3)->create();
    $user->wishlistedTourPackages()->attach($tours->pluck('id'));

    $response = $this->actingAs($user)->get(route('profile.wishlist.index'));

    $response->assertStatus(200);
    foreach ($tours as $tour) {
        $response->assertSee($tour->title);
    }
});

test('customer can remove item from wishlist via destroy route', function () {
    $user = User::factory()->create(['role' => UserRole::Customer]);
    $tour = TourPackage::factory()->create();
    $user->wishlistedTourPackages()->attach($tour->id);

    $response = $this->actingAs($user)
        ->from(route('profile.wishlist.index'))
        ->delete(route('profile.wishlist.destroy', $tour->id));

    $response->assertRedirect(route('profile.wishlist.index'));
    $response->assertSessionHas('status', 'Item berhasil dihapus dari wishlist.');

    expect($user->wishlistedTourPackages()->where('tour_package_id', $tour->id)->exists())->toBeFalse();
});
