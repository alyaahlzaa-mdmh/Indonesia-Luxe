<?php

namespace App\Http\Controllers;

use App\Enums\PackageStatus;
use App\Models\TourPackage;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = TourPackage::query()
            ->with(['category'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('status', PackageStatus::Published->value)
            ->where('is_active', true)
            ->latest()
            ->limit(8)
            ->get();

        return view('home', [
            'featuredPackages' => $featuredPackages,
        ]);
    }
}
