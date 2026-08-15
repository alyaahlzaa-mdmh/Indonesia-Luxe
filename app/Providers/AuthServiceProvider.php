<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Order;
use App\Models\Review;
use App\Models\TourPackage;
use App\Models\VendorProfile;
use App\Policies\BookingPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\TourPackagePolicy;
use App\Policies\VendorProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Booking::class => BookingPolicy::class,
        Order::class => OrderPolicy::class,
        Review::class => ReviewPolicy::class,
        TourPackage::class => TourPackagePolicy::class,
        VendorProfile::class => VendorProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
