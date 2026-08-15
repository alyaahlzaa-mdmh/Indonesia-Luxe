<?php

namespace App\Enums;

enum PromoDiscountType: string
{
    case Percent = 'percent';
    case Flat = 'flat';

    public function label(): string
    {
        return match ($this) {
            self::Percent => 'Persen (%)',
            self::Flat => 'Nominal (Rp)',
        };
    }
}
