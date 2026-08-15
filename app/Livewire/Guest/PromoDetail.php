<?php

namespace App\Livewire\Guest;

use App\Livewire\Guest\Concerns\WithTourConfig;
use App\Livewire\Guest\Concerns\WithTourQueries;
use App\Livewire\Guest\Concerns\WithWishlist;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('components.layouts.site', ['fullWidth' => true])]
class PromoDetail extends Component
{
    use WithoutUrlPagination, WithPagination, WithTourConfig, WithTourQueries, WithWishlist;

    public string $slug;

    public string $type = '';

    public function mount(string $slug = 'pengguna-baru'): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $query = $this->buildQuery();

        return view('livewire.guest.promo-detail', [
            'tourPackages' => $query->paginate(8),
            'featuredPackages' => $this->getFeaturedPackages(4),
            'categories' => $this->getCategories(),
            'typeLabels' => self::getTypeLabels(),
        ]);
    }

    private function buildQuery()
    {
        $query = $this->publishedPackagesQuery();

        if ($this->type !== '') {
            $query->where('type', $this->type);
        }

        return $query->latest();
    }
}
