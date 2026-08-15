<?php

namespace App\Policies;

use App\Enums\PackageStatus;
use App\Models\TourPackage;
use App\Models\User;

class TourPackagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isVendor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TourPackage $tourPackage): bool
    {
        return $user->isAdmin()
            || $tourPackage->status === PackageStatus::Published
            || $tourPackage->vendor_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isVendor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TourPackage $tourPackage): bool
    {
        return $user->isAdmin() || ($user->isVendor() && $tourPackage->vendor_id === $user->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TourPackage $tourPackage): bool
    {
        return $user->isAdmin() || ($user->isVendor() && $tourPackage->vendor_id === $user->id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TourPackage $tourPackage): bool
    {
        return $this->delete($user, $tourPackage);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TourPackage $tourPackage): bool
    {
        return $user->isAdmin();
    }
}
