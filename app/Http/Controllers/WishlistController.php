<?php

namespace App\Http\Controllers;

use App\Livewire\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlistedTourPackages()
            ->with(['category', 'vendor.vendorProfile'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();

        return view('wishlists.index', [
            'wishlist' => $wishlist,
        ]);
    }

    /**
     * Remove an item from the wishlist.
     */
    public function destroy(int|string $tourPackageId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->wishlistedTourPackages()->where('tour_package_id', $tourPackageId)->exists()) {
            $user->wishlistedTourPackages()->detach($tourPackageId);

            return back()->with('status', 'Item berhasil dihapus dari wishlist.');
        }

        return back()->with('status', 'Item gagal dihapus dari wishlist.');
    }
}
