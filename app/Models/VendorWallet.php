<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorWallet extends Model
{
    /** @use HasFactory<\Database\Factories\VendorWalletFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'total_earned',
        'total_withdrawn',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'total_earned' => 'decimal:2',
            'total_withdrawn' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(WalletWithdrawal::class);
    }

    public function recentWithdrawals(): HasMany
    {
        return $this->hasMany(WalletWithdrawal::class)->latest()->limit(4);
    }

    public function addEarning(float $amount, ?int $bookingId = null, ?string $description = null): void
    {
        $this->increment('balance', $amount);
        $this->increment('total_earned', $amount);

        $this->transactions()->create([
            'type' => 'earning',
            'amount' => $amount,
            'description' => $description,
            'booking_id' => $bookingId,
        ]);
    }

    public function canWithdraw(float $amount): bool
    {
        return $this->balance >= $amount && $amount >= 50000;
    }
}
