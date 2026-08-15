<?php

namespace App\Models;

use App\Enums\WithdrawalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WalletWithdrawal extends Model
{
    /** @use HasFactory<\Database\Factories\WalletWithdrawalFactory> */
    use HasFactory;

    protected $fillable = [
        'vendor_wallet_id',
        'amount',
        'status',
        'bank_details',
        'notes',
        'rejection_reason',
        'processed_by_user_id',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => WithdrawalStatus::class,
            'amount' => 'decimal:2',
            'bank_details' => 'array',
            'processed_at' => 'datetime',
        ];
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(VendorWallet::class, 'vendor_wallet_id');
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by_user_id');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(WalletTransaction::class, 'withdrawal_id');
    }

    public function isPending(): bool
    {
        return $this->status === WithdrawalStatus::Pending;
    }
}
