<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'vendor_id',
        'tour_package_id',
        'tour_departure_slot_id',
        'package_title',
        'departure_date',
        'quantity',
        'price_per_person',
        'line_total',
        'status',
        'pickup_point',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'departure_date' => 'date',
            'quantity' => 'integer',
            'price_per_person' => 'decimal:2',
            'line_total' => 'decimal:2',
            'status' => BookingStatus::class,
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(TourDepartureSlot::class, 'tour_departure_slot_id');
    }

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }
}
