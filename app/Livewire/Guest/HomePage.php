<?php

namespace App\Livewire\Guest;

use App\Livewire\Guest\Concerns\WithTourConfig;
use App\Livewire\Guest\Concerns\WithTourQueries;
use App\Livewire\Guest\Concerns\WithWishlist;
use Livewire\Component;

class HomePage extends Component
{
    use WithTourConfig, WithTourQueries, WithWishlist;

    public function render()
    {
        return view('livewire.guest.home-page', [
            'featuredPackages' => $this->getFeaturedPackages(),
            'categories' => $this->getCategories(),
            'typeCounts' => $this->getTypeCounts(),
            'activityMeta' => self::ACTIVITY_META,
            'typeLabels' => self::getTypeLabels(),
        ]);
    }
}
