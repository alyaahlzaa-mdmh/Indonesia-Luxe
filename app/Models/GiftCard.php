<?php

namespace App\Models;

use App\Enums\PromoStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GiftCard extends Model
{
    /** @use HasFactory<\Database\Factories\GiftCardFactory> */
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'code',
        'value',
        'expires_at',
        'max_usages',
        'used_count',
        'is_active',
        'status',
        'rejected_reason',
    ];

    protected function casts(): array
    {
        return [
            'status' => PromoStatus::class,
            'value' => 'decimal:2',
            'is_active' => 'boolean',
            'expires_at' => 'date',
            'max_usages' => 'integer',
            'used_count' => 'integer',
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
