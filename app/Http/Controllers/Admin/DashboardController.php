<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentSubmission;
use App\Models\TourPackage;
use App\Models\VendorProfile;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'pendingVendors' => VendorProfile::query()->where('status', 'pending')->count(),
            'pendingPackages' => TourPackage::query()->where('status', 'pending_approval')->count(),
            'pendingPayments' => PaymentSubmission::query()->where('status', 'pending')->count(),
            'totalTransactions' => Order::query()->count(),
        ]);
    }
}
