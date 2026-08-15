<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\View\View;

class VendorReviewController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $packageIds = $user->tourPackages()->pluck('id');

        $reviews = Review::query()
            ->whereIn('tour_package_id', $packageIds)
            ->with(['user', 'tourPackage'])
            ->latest()
            ->paginate(15);

        $totalReviews = Review::query()
            ->whereIn('tour_package_id', $packageIds)
            ->count();

        $averageRating = Review::query()
            ->whereIn('tour_package_id', $packageIds)
            ->avg('rating');

        return view('vendor.review.index', [
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => round($averageRating ?? 0, 1),
        ]);
    }
}
