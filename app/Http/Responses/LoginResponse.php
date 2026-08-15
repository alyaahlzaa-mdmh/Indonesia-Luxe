<?php

namespace App\Http\Responses;

use App\Enums\UserRole;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $request->user();

        $redirect = match ($user->role) {
            UserRole::Admin => route('admin.dashboard'),
            UserRole::Vendor => $user->isVendorApproved() ? route('vendor.dashboard') : route('vendor.pending'),
            UserRole::Customer => route('home'),
            default => config('fortify.home'),
        };

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($redirect);
    }
}
