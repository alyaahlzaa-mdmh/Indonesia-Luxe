<?php

namespace Tests\Unit;

use App\Models\TourPackage;
use Illuminate\Support\Facades\Storage;

test('coverImageUrl returns default when path is empty', function () {
    $package = new TourPackage;
    $package->cover_image_path = null;

    expect($package->coverImageUrl())->toContain('images/hero1.jpg');
});

test('coverImageUrl returns full url when path is a url', function () {
    $package = new TourPackage;
    $package->cover_image_path = 'https://example.com/image.jpg';

    expect($package->coverImageUrl())->toBe('https://example.com/image.jpg');
});

test('coverImageUrl returns storage url when path is a local path', function () {
    Storage::fake('public');
    $package = new TourPackage;
    $package->cover_image_path = 'custom-covers/bromo.jpg';

    $url = $package->coverImageUrl();

    expect($url)->toContain('/storage/custom-covers/bromo.jpg');
});
