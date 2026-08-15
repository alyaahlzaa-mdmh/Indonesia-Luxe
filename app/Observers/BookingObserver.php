<?php

namespace App\Observers;

use App\Enums\BookingStatus;
use App\Models\Booking;

class BookingObserver
{
    public function updated(Booking $booking): void
    {
        // Check if booking status changed to confirmed
        if ($booking->isDirty('status') && $booking->status === BookingStatus::Confirmed) {
            $this->addVendorEarning($booking);
        }
    }

    private function addVendorEarning(Booking $booking): void
    {
        $vendor = $booking->vendor;
        $orderItem = $booking->orderItem;

        if (! $vendor || ! $orderItem) {
            return;
        }

        // Calculate vendor earning (80% of line total)
        $vendorEarning = $orderItem->line_total * 0.8;

        // Get or create vendor wallet
        $wallet = $vendor->vendorWallet()->firstOrCreate([
            'user_id' => $vendor->id,
        ]);

        // Add earning to wallet
        $wallet->addEarning(
            amount: $vendorEarning,
            bookingId: $booking->id,
            description: "Penghasilan dari booking {$orderItem->package_title}"
        );
    }
}
