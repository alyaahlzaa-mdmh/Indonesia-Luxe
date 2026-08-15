<?php

namespace App\Models;

use App\Enums\PromoDiscountType;
use App\Enums\PromoStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promo extends Model
{
    /** @use HasFactory<\Database\Factories\PromoFactory> */
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'code',
        'description',
        'group',
        'discount_type',
        'discount_value',
        'min_purchase',
        'category_restriction',
        'valid_from',
        'valid_until',
        'is_active',
        'status',
        'rejected_reason',
    ];

    protected function casts(): array
    {
        return [
            'discount_type' => PromoDiscountType::class,
            'status' => PromoStatus::class,
            'discount_value' => 'decimal:2',
            'min_purchase' => 'decimal:2',
            'is_active' => 'boolean',
            'valid_from' => 'date',
            'valid_until' => 'date',
        ];
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function scopePendingApproval(Builder $query): Builder
    {
        return $query->where('status', PromoStatus::PendingApproval);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', PromoStatus::Active);
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', PromoStatus::Rejected);
    }

    public function isInternal(): bool
    {
        return $this->vendor?->isAdmin() ?? false;
    }
}
