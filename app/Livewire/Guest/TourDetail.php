<?php

namespace App\Livewire\Guest;

use App\Livewire\Guest\Concerns\WithTourConfig;
use App\Livewire\Guest\Concerns\WithTourQueries;
use App\Livewire\Guest\Concerns\WithWishlist;
use App\Models\TourPackage;
use Livewire\Component;

class TourDetail extends Component
{
    use WithTourConfig, WithTourQueries, WithWishlist;

    public TourPackage $tourPackage;

    public function mount(TourPackage $tourPackage): void
    {
        $tourPackage->loadAvg('reviews', 'rating');
        $tourPackage->loadCount('reviews');
        $tourPackage->load(['vendor.vendorProfile', 'reviews.user', 'slots', 'category', 'itineraries', 'pickupPoints']);

        $this->tourPackage = $tourPackage;
    }

    public function render()
    {
        $typeLabels = self::getTypeLabels();

        return view('livewire.guest.tour-detail', [
            'typeLabel' => $typeLabels[$this->tourPackage->type->value] ?? $this->tourPackage->type->value,
            'heroImages' => $this->getHeroImages(),
        ]);
    }

    private function getHeroImages(): array
    {
        $images = [$this->tourPackage->coverImageUrl()];

        $images[] = asset('images/hero2.jpg');
        $images[] = asset('images/hero3.jpg');
        $images[] = asset('images/hero4.jpg');

        return array_values(array_unique($images));
    }
}
