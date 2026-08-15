<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
  Storage::fake('public');
});

test('profile edit page is accessible for customer', function () {
  $user = User::factory()->customer()->create();

  $this->actingAs($user)
    ->get(route('profile.edit'))
    ->assertOk()
    ->assertSee($user->name);
});

test('user can update their profile information', function () {
  $user = User::factory()->customer()->create([
    'name' => 'Old Name',
    'title' => 'Mr',
  ]);

  $avatar = UploadedFile::fake()->image('my-avatar.jpg');

  $response = $this->actingAs($user)
    ->put(route('profile.update'), [
      'name' => 'New Name',
      'title' => 'Dr',
      'country' => 'Indonesia',
      'dob_day' => '15',
      'dob_month' => '08',
      'dob_year' => '1995',
      'avatar' => $avatar,
    ]);

  $response->assertRedirect(route('profile.edit'))
    ->assertSessionHas('status', 'Profile updated successfully!');

  $user->refresh();

  expect($user->name)->toBe('New Name');
  expect($user->title)->toBe('Dr');
  expect($user->country)->toBe('Indonesia');
  expect($user->date_of_birth->format('Y-m-d'))->toBe('1995-08-15');
  expect($user->avatar)->not->toBeNull();

  Storage::disk('public')->assertExists($user->avatar);
});

test('profile update validation rules', function () {
  $user = User::factory()->customer()->create();

  $this->actingAs($user)
    ->put(route('profile.update'), [
      'name' => '', // mandatory
      'title' => 'Invalid', // not in allowed list
      'dob_day' => '1', // too short, must be size:2
    ])
    ->assertSessionHasErrors(['name', 'title', 'dob_day']);
});
