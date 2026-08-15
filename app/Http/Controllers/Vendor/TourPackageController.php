<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\PackageStatus;
use App\Enums\PackageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourPackageRequest;
use App\Http\Requests\UpdateTourPackageRequest;
use App\Models\TourCategory;
use App\Models\TourPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tourPackages = $user->tourPackages()
            ->with('category')
            ->latest()
            ->paginate(15);

        return view('vendor.packages.index', [
            'tourPackages' => $tourPackages,
            'counts' => [
                'total' => $user->tourPackages()->count(),
                'active' => $user->tourPackages()->where('status', PackageStatus::Published)->count(),
                'pending' => $user->tourPackages()->where('status', PackageStatus::PendingApproval)->count(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.packages.create', [
            'categories' => TourCategory::query()->orderBy('name')->get(),
            'packageTypes' => PackageType::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourPackageRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            return DB::transaction(function () use ($request, $validated) {
                // 1. Handle Cover Image
                $coverPath = $request->file('cover_image')->store('tour-covers', 'public');

                // 2. Handle Extra Photos
                $extraPhotosPaths = [];
                if ($request->hasFile('extra_photos')) {
                    $photos = $request->file('extra_photos');
                    // Flatten in case of nested arrays (though multiple was removed)
                    $photos = is_array($photos) ? \Illuminate\Support\Arr::flatten($photos) : [$photos];

                    foreach ($photos as $photo) {
                        if ($photo instanceof \Illuminate\Http\UploadedFile && $photo->isValid()) {
                            $extraPhotosPaths[] = $photo->store('tour-photos', 'public');
                        }
                    }
                }

                // 3. Create Tour Package
                $tourPackage = TourPackage::query()->create([
                    'vendor_id' => auth()->id(),
                    'tour_category_id' => $validated['tour_category_id'],
                    'status' => PackageStatus::Draft,
                    'type' => $validated['type'],
                    'title' => $validated['title'],
                    'slug' => $this->generateUniqueSlug($validated['title']),
                    'description' => $validated['description'],
                    'meeting_point' => $validated['meeting_point'],
                    'duration' => $validated['duration'],
                    'max_participants' => $validated['max_participants'],
                    'price_per_person' => $validated['price_per_person'],
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'],
                    'cover_image_path' => $coverPath,
                    'extra_photos' => $extraPhotosPaths,
                    'highlights' => ! empty($validated['highlights']) ? array_filter($validated['highlights']) : null,
                    'included' => ! empty($validated['included']) ? array_filter($validated['included']) : null,
                ]);

                // 4. Create Itineraries
                if (isset($validated['itineraries'])) {
                    foreach ($validated['itineraries'] as $index => $itineraryData) {
                        if (! empty($itineraryData['description'])) {
                            $tourPackage->itineraries()->create([
                                'day_number' => $index + 1,
                                'description' => $itineraryData['description'],
                                'title' => 'Hari '.($index + 1), // Default title
                            ]);
                        }
                    }
                }

                // 5. Create Pickup Points
                if (isset($validated['pickup_points'])) {
                    foreach ($validated['pickup_points'] as $index => $location) {
                        if (! empty($location)) {
                            $tourPackage->pickupPoints()->create([
                                'location_name' => $location,
                                'order' => $index + 1,
                            ]);
                        }
                    }
                }

                return redirect()->route('vendor.packages.edit', $tourPackage)
                    ->with('status', 'Paket tour berhasil dikirim untuk persetujuan admin.');
            });
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan paket tour: '.$e->getMessage());

            return back()->withInput()->with('error', 'Gagal menyimpan paket tour. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TourPackage $tourPackage): RedirectResponse
    {
        $this->authorize('view', $tourPackage);

        return redirect()->route('vendor.packages.edit', $tourPackage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourPackage $tourPackage)
    {
        $this->authorize('update', $tourPackage);

        $user = auth()->user();

        return view('vendor.packages.edit', [
            'tourPackage' => $tourPackage->load(['slots', 'itineraries', 'pickupPoints']),
            'categories' => TourCategory::query()->orderBy('name')->get(),
            'packageTypes' => PackageType::cases(),
            'counts' => [
                'total' => $user->tourPackages()->count(),
                'active' => $user->tourPackages()->where('status', PackageStatus::Published)->count(),
                'pending' => $user->tourPackages()->where('status', PackageStatus::PendingApproval)->count(),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourPackageRequest $request, TourPackage $tourPackage): RedirectResponse
    {
        $this->authorize('update', $tourPackage);

        $validated = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($tourPackage->cover_image_path !== null) {
                Storage::disk('public')->delete($tourPackage->cover_image_path);
            }

            $tourPackage->cover_image_path = $request->file('cover_image')->store('tour-covers', 'public');
        }

        $tourPackage->fill([
            'tour_category_id' => $validated['tour_category_id'],
            'type' => $validated['type'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'meeting_point' => $validated['meeting_point'] ?? null,
            'duration_hours' => $validated['duration_hours'] ?? null,
            'max_participants' => $validated['max_participants'] ?? null,
            'price_per_person' => $validated['price_per_person'],
        ]);

        if ($tourPackage->isDirty('title')) {
            $tourPackage->slug = $this->generateUniqueSlug($validated['title'], $tourPackage->id);
        }

        if ($tourPackage->status === PackageStatus::Rejected) {
            $tourPackage->status = PackageStatus::Draft;
            $tourPackage->rejected_reason = null;
        }

        $tourPackage->save();

        return back()->with('status', 'Paket tour berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourPackage $tourPackage): RedirectResponse
    {
        $this->authorize('delete', $tourPackage);

        $tourPackage->delete();

        return redirect()->route('vendor.packages.index')->with('status', 'Paket tour berhasil dihapus.');
    }

    public function submit(TourPackage $tourPackage): RedirectResponse
    {
        $this->authorize('update', $tourPackage);

        $tourPackage->status = PackageStatus::PendingApproval;
        $tourPackage->rejected_reason = null;
        $tourPackage->save();

        return back()->with('status', 'Paket dikirim untuk persetujuan admin.');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 1;

        while (TourPackage::query()
            ->when($ignoreId !== null, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = sprintf('%s-%d', $base, $counter);
            $counter++;
        }

        return $slug;
    }
}
