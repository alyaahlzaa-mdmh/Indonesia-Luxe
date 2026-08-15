<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $request->user();

        $redirect = match ($user?->role) {
            \App\Enums\UserRole::Admin => route('admin.dashboard'),
            \App\Enums\UserRole::Vendor => route('vendor.pending'),
            \App\Enums\UserRole::Customer => route('home'),
            default => route('home'),
        };

        return $request->wantsJson()
            ? response()->json(['status' => 'success'])
            : redirect()->intended($redirect);
    }
}
