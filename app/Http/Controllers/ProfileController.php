<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $bookings = $user->bookings()
            ->with(['tourPackage', 'orderItem'])
            ->latest()
            ->get();

        return view('profile.index', [
            'user' => $user,
            'bookings' => $bookings,
            'upcomingBookings' => $bookings->whereIn('status', [\App\Enums\BookingStatus::Pending, \App\Enums\BookingStatus::Confirmed]),
            'completedBookings' => $bookings->where('status', \App\Enums\BookingStatus::Completed),
            'cancelledBookings' => $bookings->where('status', \App\Enums\BookingStatus::Cancelled),
        ]);
    }
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|in:Mr,Mrs,Ms,Mx,Dr',
            'country' => 'nullable|string|max:255',
            'dob_day' => 'nullable|string|size:2',
            'dob_month' => 'nullable|string|size:2',
            'dob_year' => 'nullable|string|size:4',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->title = $validated['title'];
        $user->country = $validated['country'];

        if ($validated['dob_day'] && $validated['dob_month'] && $validated['dob_year']) {
            $user->date_of_birth = Carbon::createFromDate($validated['dob_year'], $validated['dob_month'], $validated['dob_day'])->toDateString();
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
    }
}
