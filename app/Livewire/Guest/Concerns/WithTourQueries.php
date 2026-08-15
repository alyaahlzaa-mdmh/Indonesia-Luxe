<?php

namespace App\Livewire\Guest\Concerns;

use App\Enums\PackageStatus;
use App\Models\TourCategory;
use App\Models\TourPackage;
use Illuminate\Support\Collection;

/**
 * Shared tour query methods used across multiple guest Livewire components.
 */
trait WithTourQueries
{
    /**
     * Get published tour packages base query.
     */
    protected function publishedPackagesQuery()
    {
        return TourPackage::query()
            ->with(['category', 'vendor.vendorProfile'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('status', PackageStatus::Published->value)
            ->where('is_active', true);
    }

    /**
     * Get featured/latest published packages.
     */
    protected function getFeaturedPackages(int $limit = 6): Collection
    {
        return $this->publishedPackagesQuery()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get all categories with package counts.
     */
    protected function getCategories(): Collection
    {
        return TourCategory::query()
            ->withCount('tourPackages')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get type counts for published packages.
     */
    protected function getTypeCounts(): Collection
    {
        return TourPackage::query()
            ->where('status', PackageStatus::Published->value)
            ->where('is_active', true)
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type');
    }

    /**
     * Get max price upper bound for filters.
     */
    protected function getMaxPriceUpperBound(): int
    {
        return (int) ceil(
            TourPackage::query()
                ->where('status', PackageStatus::Published->value)
                ->where('is_active', true)
                ->max('price_per_person') ?? 15000000
        );
    }
}
