<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\BookingStatus;
use App\Enums\PackageStatus;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Package stats
        $totalPackages = $user->tourPackages()->count();
        $activePackages = $user->tourPackages()->where('status', PackageStatus::Published)->count();
        $pendingPackages = $user->tourPackages()->whereIn('status', [PackageStatus::Draft, PackageStatus::PendingApproval])->count();

        // Booking stats
        $vendorBookings = $user->vendorBookings();
        $totalOrders = (clone $vendorBookings)->count();
        $pendingBookingsCount = (clone $vendorBookings)->where('status', BookingStatus::Pending)->count();
        $confirmedBookingsCount = (clone $vendorBookings)->whereIn('status', [BookingStatus::Confirmed, BookingStatus::Completed])->count();

        // Revenue (from confirmed/completed bookings)
        $confirmedRevenue = OrderItem::where('vendor_id', $user->id)
            ->whereHas('booking', function ($query) {
                $query->whereIn('status', [BookingStatus::Confirmed, BookingStatus::Completed]);
            })
            ->sum('line_total');

        // Get or create wallet for balance
        $wallet = $user->vendorWallet()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        // Recent bookings for the list
        $recentBookings = $user->vendorBookings()
            ->with(['user', 'tourPackage'])
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', [
            'user' => $user,
            'totalPackages' => $totalPackages,
            'activePackages' => $activePackages,
            'pendingPackages' => $pendingPackages,
            'totalOrders' => $totalOrders,
            'pendingBookingsCount' => $pendingBookingsCount,
            'confirmedBookingsCount' => $confirmedBookingsCount,
            'confirmedRevenue' => $confirmedRevenue,
            'recentBookings' => $recentBookings,
            'walletBalance' => $wallet->balance,
            'rating' => 0.0,
        ]);
    }
}
