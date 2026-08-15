<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PendingPayment = 'pending_payment';
    case AwaitingValidation = 'awaiting_validation';
    case Paid = 'paid';
    case PartiallyConfirmed = 'partially_confirmed';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PendingPayment => 'Menunggu Pembayaran',
            self::AwaitingValidation => 'Menunggu Verifikasi',
            self::Paid => 'Sudah Bayar',
            self::PartiallyConfirmed => 'Terkonfirmasi Sebagian',
            self::Completed => 'Selesai',
            self::Cancelled => 'Dibatalkan',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-orange-100 text-orange-700',
            self::AwaitingValidation => 'bg-yellow-100 text-yellow-700',
            self::Paid => 'bg-green-100 text-green-700',
            self::PartiallyConfirmed => 'bg-blue-100 text-blue-700',
            self::Completed => 'bg-emerald-100 text-emerald-700',
            self::Cancelled => 'bg-red-100 text-red-700',
        };
    }

    public function backgroundColor(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-orange-500',
            self::AwaitingValidation => 'bg-yellow-500',
            self::Paid => 'bg-green-500',
            self::PartiallyConfirmed => 'bg-blue-500',
            self::Completed => 'bg-emerald-500',
            self::Cancelled => 'bg-red-500',
        };
    }
    public function textColor(): string
    {
        return match ($this) {
            self::PendingPayment => 'text-orange-700',
            self::AwaitingValidation => 'text-yellow-700',
            self::Paid => 'text-green-700',
            self::PartiallyConfirmed => 'text-blue-700',
            self::Completed => 'text-emerald-700',
            self::Cancelled => 'text-red-700',
        };
    }

    public function labelVendor(): string
    {
        return match ($this) {
            self::PendingPayment => 'Pending',
            self::AwaitingValidation => 'Proof Uploaded',
            self::Paid => 'Paid',
            self::PartiallyConfirmed => 'Partially Confirmed',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function colorVendor(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-yellow-100 text-yellow-700',
            self::AwaitingValidation => 'bg-blue-100 text-blue-700',
            self::Paid => 'bg-green-100 text-green-700',
            self::PartiallyConfirmed => 'bg-green-100 text-green-700',
            self::Completed => 'bg-emerald-100 text-emerald-700',
            self::Cancelled => 'bg-red-100 text-red-700',
        };
    }

    public function colorAdmin(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-[#fff8ed] text-[#f59e0b]',
            self::AwaitingValidation => 'bg-[#e0f2fe] text-[#0ea5e9]',
            self::Paid => 'bg-[#e8fff3] text-[#10b981]',
            self::PartiallyConfirmed => 'bg-[#eff6ff] text-[#3b82f6]',
            self::Completed => 'bg-[#f0fdf4] text-[#15803d]',
            self::Cancelled => 'bg-[#fef2f2] text-[#ef4444]',
        };
    }
}
