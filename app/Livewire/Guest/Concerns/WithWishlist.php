<?php

namespace App\Livewire\Guest\Concerns;

use Illuminate\Support\Facades\Auth;

trait WithWishlist
{
    /**
     * Toggles a tour package in the user's wishlist.
     *
     * @param  int|string  $tourPackageId
     */
    public function toggleWishlist($tourPackageId): void
    {
        if (! Auth::check()) {
            $this->dispatch('action-toast', message: 'Silakan login terlebih dahulu untuk menyimpan wishlist ❤️', status: 'guest');

            return;
        }

        $user = Auth::user();
        /** @var \App\Models\User $user */
        if ($user->wishlistedTourPackages()->where('tour_package_id', $tourPackageId)->exists()) {
            $user->wishlistedTourPackages()->detach($tourPackageId);
            $this->dispatch('action-toast', id: $tourPackageId, message: 'Dihapus dari wishlist 💔', status: 'removed');
        } else {
            $user->wishlistedTourPackages()->attach($tourPackageId);
            $this->dispatch('action-toast', id: $tourPackageId, message: 'Ditambahkan ke wishlist ❤️', status: 'added');
        }
    }
}
