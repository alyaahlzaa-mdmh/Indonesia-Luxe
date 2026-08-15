<?php

namespace App\Enums;

enum PaymentValidationStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-700',
            self::Approved => 'bg-green-100 text-green-700',
            self::Rejected => 'bg-red-100 text-red-700',
        };
    }
}
