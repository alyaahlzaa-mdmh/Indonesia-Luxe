<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VendorProfile;

class VendorProfilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VendorProfile $vendorProfile): bool
    {
        return $user->isAdmin() || $vendorProfile->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isVendor() && $user->vendorProfile === null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VendorProfile $vendorProfile): bool
    {
        return $user->isAdmin() || $vendorProfile->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VendorProfile $vendorProfile): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VendorProfile $vendorProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VendorProfile $vendorProfile): bool
    {
        return false;
    }
}
