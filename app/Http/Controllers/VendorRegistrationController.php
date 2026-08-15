<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Http\Requests\StoreVendorRegistrationRequest;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorRegistrationController extends Controller
{
    public function create()
    {
        return view('vendor.auth.register');
    }

    public function store(StoreVendorRegistrationRequest $request)
    {
        $validated = $request->validated();

        $vendor = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => UserRole::Vendor,
            'password' => Hash::make($validated['password']),
        ]);

        VendorProfile::query()->create([
            'user_id' => $vendor->id,
            'status' => VendorStatus::Pending,
            'business_name' => $validated['business_name'],
            'business_description' => $validated['business_description'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account_name' => $validated['bank_account_name'] ?? null,
            'bank_account_number' => $validated['bank_account_number'] ?? null,
        ]);

        Auth::login($vendor);

        return redirect()->route('vendor.pending');
    }
}
