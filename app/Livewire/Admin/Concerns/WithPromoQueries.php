<?php

namespace App\Livewire\Admin\Concerns;

use App\Enums\PromoStatus;
use App\Models\GiftCard;
use App\Models\Promo;
use Illuminate\Database\Eloquent\Builder;

trait WithPromoQueries
{
    protected function currentPromoModel(): string
    {
        return $this->activeType === 'promo' ? Promo::class : GiftCard::class;
    }

    protected function currentPromoQuery(): Builder
    {
        $model = $this->currentPromoModel();

        return $model::query()->with('vendor');
    }

    public function getStats(): array
    {
        $query = $this->currentPromoQuery();

        return [
            'pendingCount' => (clone $query)->where('status', PromoStatus::PendingApproval)->count(),
            'approvedCount' => (clone $query)->where('status', PromoStatus::Active)->count(),
            'rejectedCount' => (clone $query)->where('status', PromoStatus::Rejected)->count(),
        ];
    }

    public function buildQuery(): Builder
    {
        $query = $this->currentPromoQuery();

        $query->where('status', $this->statusFilter);

        if ($this->search) {
            $searchTerm = '%'.$this->search.'%';

            $query->where(function (Builder $builder) use ($searchTerm): void {
                $builder->where('code', 'like', $searchTerm)
                    ->orWhereHas('vendor', function (Builder $vendorQuery) use ($searchTerm): void {
                        $vendorQuery->where('name', 'like', $searchTerm);
                    });

                if ($this->activeType === 'promo') {
                    $builder->orWhere('description', 'like', $searchTerm)
                        ->orWhere('group', 'like', $searchTerm);
                }
            });
        }

        return $query->latest();
    }
}
