<?php

namespace App\Livewire\Guest;

use App\Livewire\Guest\Concerns\WithTourConfig;
use App\Livewire\Guest\Concerns\WithTourQueries;
use App\Livewire\Guest\Concerns\WithWishlist;
use App\Models\TourCategory;
use Livewire\Component;
use Livewire\WithPagination;

class TourSearch extends Component
{
    use WithPagination, WithTourConfig, WithTourQueries, WithWishlist;

    public string $q = '';

    public string $category = '';

    public string $type = '';

    // Advanced filter properties
    public bool $showFilterPanel = false;

    public int $maxPrice = 15000000;

    public string $minRating = '';

    public string $sortBy = 'terbaru';

    protected $queryString = [
        'q' => ['except' => ''],
        'category' => ['except' => ''],
        'type' => ['except' => ''],
        'sortBy' => ['except' => 'terbaru'],
        'minRating' => ['except' => ''],
        'maxPrice' => ['except' => ''],
    ];

    public function mount(): void
    {
        $upperBound = $this->getMaxPriceUpperBound();

        if ($this->maxPrice === 15000000 || $this->maxPrice > $upperBound) {
            $this->maxPrice = $upperBound;
        }
    }

    public function toggleFilterPanel(): void
    {
        $this->showFilterPanel = ! $this->showFilterPanel;
    }

    public function closeFilterPanel(): void
    {
        $this->showFilterPanel = false;
    }

    public function applyFilters(): void
    {
        $this->resetPage();
        $this->showFilterPanel = false;
    }

    public function resetFilters(): void
    {
        $this->q = '';
        $this->type = '';
        $this->category = '';
        $this->minRating = '';
        $this->sortBy = 'terbaru';
        $this->maxPrice = $this->getMaxPriceUpperBound();
        $this->resetPage();
    }

    public function getActiveFilterCount(): int
    {
        $count = 0;
        if ($this->category) {
            $count++;
        }
        if ($this->type) {
            $count++;
        }
        if ($this->minRating !== '') {
            $count++;
        }
        if ($this->maxPrice < $this->getMaxPriceUpperBound()) {
            $count++;
        }

        return $count;
    }

    public function updating($field): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = $this->buildQuery();

        return view('livewire.guest.tour-search', [
            'tourPackages' => $query->paginate(12),
            'categories' => TourCategory::query()->orderBy('name')->get(),
            'totalResults' => $query->count(),
            'typeLabels' => self::getTypeLabels(),
            'sortOptions' => self::SORT_OPTIONS,
            'ratingOptions' => self::RATING_OPTIONS,
            'maxPriceUpperBound' => $this->getMaxPriceUpperBound(),
        ]);
    }

    private function buildQuery()
    {
        $query = $this->publishedPackagesQuery();

        if ($this->q) {
            $search = $this->q;
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('meeting_point', 'like', "%{$search}%");
            });
        }

        if ($this->category) {
            $categorySlug = $this->category;
            $query->whereHas('category', function ($categoryQuery) use ($categorySlug) {
                $categoryQuery->where('slug', $categorySlug);
            });
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        // Max price filter
        $query->where('price_per_person', '<=', $this->maxPrice);

        // Min rating filter
        if ($this->minRating !== '') {
            $minRatingValue = (float) $this->minRating;
            $query->having('reviews_avg_rating', '>=', $minRatingValue);
        }

        // Sorting
        match ($this->sortBy) {
            'harga_terendah' => $query->orderBy('price_per_person', 'asc'),
            'harga_tertinggi' => $query->orderByDesc('price_per_person'),
            'rating_tertinggi' => $query->orderByDesc('reviews_avg_rating'),
            'paling_populer' => $query->orderByDesc('reviews_count'),
            default => $query->orderByDesc('created_at'),
        };

        return $query;
    }
}
