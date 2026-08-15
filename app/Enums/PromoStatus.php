<?php

namespace App\Enums;

enum PromoStatus: string
{
    case Draft = 'draft';
    case PendingApproval = 'pending_approval';
    case Active = 'active';
    case Rejected = 'rejected';
    case Expired = 'expired';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::PendingApproval => 'Menunggu',
            self::Active => 'Aktif',
            self::Rejected => 'Ditolak',
            self::Expired => 'Kedaluwarsa',
        };
    }

    public function textColor(): string
    {
        return match ($this) {
            self::Draft => 'text-gray-600',
            self::PendingApproval => 'text-amber-700',
            self::Active => 'text-emerald-700',
            self::Rejected => 'text-red-700',
            self::Expired => 'text-slate-600',
        };
    }

    public function backgroundColor(): string
    {
        return match ($this) {
            self::Draft => 'bg-gray-500',
            self::PendingApproval => 'bg-amber-500',
            self::Active => 'bg-emerald-500',
            self::Rejected => 'bg-red-500',
            self::Expired => 'bg-slate-500',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Draft => 'bg-gray-50 text-gray-600 border border border-gray-200',
            self::PendingApproval => 'bg-amber-50 text-amber-700 border border border-amber-200',
            self::Active => 'bg-emerald-50 text-emerald-700 border border border-emerald-200',
            self::Rejected => 'bg-red-50 text-red-700 border border border-red-200',
            self::Expired => 'bg-slate-50 text-slate-600 border border border-slate-200',
        };
    }
}
