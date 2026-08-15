<?php

namespace App\Livewire\Admin\Concerns;

use App\Models\VendorProfile;
use Illuminate\Database\Eloquent\Builder;

trait WithVendorQueries
{
    /**
     * Build the vendor query with filters and sorting.
     */
    protected function buildVendorQuery(): Builder
    {
        $query = VendorProfile::with('user')->latest();

        if (property_exists($this, 'search') && $this->search) {
            $query->where(function ($q) {
                $q->where('business_name', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', function ($uq) {
                        $uq->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('email', 'like', '%'.$this->search.'%');
                    });
            });
        }

        if (property_exists($this, 'statusFilter') && $this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query;
    }

    /**
     * Get vendor statistics.
     */
    protected function getVendorStats(): array
    {
        return [
            'totalCount' => VendorProfile::count(),
            'approvedCount' => VendorProfile::where('status', 'approved')->count(),
            'pendingCount' => VendorProfile::where('status', 'pending')->count(),
            'rejectedCount' => VendorProfile::where('status', 'rejected')->count(),
        ];
    }
}
