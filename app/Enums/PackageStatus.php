<?php

namespace App\Enums;

enum PackageStatus: string
{
    case Draft = 'draft';
    case PendingApproval = 'pending_approval';
    case Published = 'published';
    case Rejected = 'rejected';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::PendingApproval => 'Pending',
            self::Published => 'Approved',
            self::Rejected => 'Rejected',
            self::Archived => 'Archived',
        };
    }

    public function badgeLabel(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::PendingApproval => 'Menunggu',
            self::Published => 'Disetujui',
            self::Rejected => 'Ditolak',
            self::Archived => 'Diarsipkan',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Draft => 'bg-gray-500/90 text-white',
            self::PendingApproval => 'bg-amber-500/90 text-white',
            self::Published => 'bg-emerald-500/90 text-white',
            self::Rejected => 'bg-red-500/90 text-white',
            self::Archived => 'bg-slate-500/90 text-white',
        };
    }

    public function textColor(): string
    {
        return match ($this) {
            self::Draft => 'text-gray-700',
            self::PendingApproval => 'text-amber-700',
            self::Published => 'text-emerald-700',
            self::Rejected => 'text-red-700',
            self::Archived => 'text-slate-700',
        };
    }

    public function backgroundColor(): string
    {
        return match ($this) {
            self::Draft => 'bg-gray-500',
            self::PendingApproval => 'bg-amber-500',
            self::Published => 'bg-emerald-500',
            self::Rejected => 'bg-red-500',
            self::Archived => 'bg-slate-500',
        };
    }
}
