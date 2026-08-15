<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendorProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $vendorProfile = $user->vendorProfile;

        return view('vendor.profile.edit', [
            'user' => $user,
            'vendorProfile' => $vendorProfile,
        ]);
    }

    public function update(UpdateVendorProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $vendorProfile = $user->vendorProfile;

        if ($vendorProfile === null) {
            abort(404);
        }

        $validated = $request->validated();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Update user data
        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'avatar' => $validated['avatar'] ?? $user->avatar,
        ]);

        // Update vendor profile data
        $vendorProfile->update([
            'business_name' => $validated['business_name'],
            'business_description' => $validated['business_description'],
        ]);

        return back()->with('success', 'Profil vendor berhasil diperbarui.');
    }

    public function pending()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isVendorApproved()) {
            return redirect()->route('vendor.dashboard');
        }

        $waMessage = "Halo Admin Indonesia Luxe! 👋🏻\n\nSaya baru saja mendaftar sebagai Vendor dan ingin meminta percepatan proses verifikasi.\n\n👤 Detail Akun:\n• Nama: {$user->name}\n• Email: {$user->email}\n• ID: {$user->id}\n\nMohon bantuannya, terima kasih!";
        $waUrl = 'https://wa.me/'.preg_replace('/[^0-9]/', '', getAdminWhatsapp()).'?text='.urlencode($waMessage);

        return view('vendor.pending', [
            'vendorProfile' => $user->vendorProfile,
            'waUrl' => $waUrl,
        ]);
    }
}
