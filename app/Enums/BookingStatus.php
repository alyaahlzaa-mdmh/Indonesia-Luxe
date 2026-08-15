<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu Konfirmasi',
            self::Confirmed => 'Terkonfirmasi',
            self::Completed => 'Selesai',
            self::Cancelled => 'Dibatalkan',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-700',
            self::Confirmed => 'bg-blue-100 text-blue-700',
            self::Completed => 'bg-green-100 text-green-700',
            self::Cancelled => 'bg-red-100 text-red-700',
        };
    }
    public function backgroundColor(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-500',
            self::Confirmed => 'bg-blue-500',
            self::Completed => 'bg-green-500',
            self::Cancelled => 'bg-red-500',
        };
    }
    public function textColor(): string
    {
        return match ($this) {
            self::Pending => 'text-yellow-700',
            self::Confirmed => 'text-blue-700',
            self::Completed => 'text-green-700',
            self::Cancelled => 'text-red-700',
        };
    }
}
