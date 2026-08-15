<?php

namespace App\Http\Controllers;

use App\Enums\PackageStatus;
use App\Models\TourCategory;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourCatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = TourPackage::query()
            ->with(['category', 'vendor'])
            ->withAvg('reviews', 'rating')
            ->where('status', PackageStatus::Published->value)
            ->where('is_active', true)
            ->orderByDesc('created_at');

        if ($request->filled('q')) {
            $search = (string) $request->string('q');
            $query->where(function ($innerQuery) use ($search): void {
                $innerQuery
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('meeting_point', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($categoryQuery) use ($request): void {
                $categoryQuery->where('slug', $request->string('category'));
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->string('type'));
        }

        if ($request->filled('departure_date')) {
            $query->whereHas('slots', function ($slotQuery) use ($request): void {
                $slotQuery->whereDate('departure_date', $request->date('departure_date'));
            });
        }

        return view('tours.index', [
            'tourPackages' => $query->paginate(12)->withQueryString(),
            'categories' => TourCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function show(TourPackage $tourPackage)
    {
        abort_if($tourPackage->status !== PackageStatus::Published, 404);

        $tourPackage->load([
            'category',
            'vendor.vendorProfile',
            'slots' => fn ($query) => $query->whereDate('departure_date', '>=', now()->toDateString())->orderBy('departure_date'),
            'reviews.user',
        ]);

        return view('tours.show', [
            'tourPackage' => $tourPackage,
        ]);
    }
}
