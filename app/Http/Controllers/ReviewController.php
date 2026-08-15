<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Booking;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Booking $booking)
    {
        $this->authorize('create', [Review::class, $booking]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($request, $booking) {
            Review::query()->create([
                'booking_id' => $booking->id,
                'user_id' => auth()->id(),
                'tour_package_id' => $booking->tour_package_id,
                'rating' => $request->integer('rating'),
                'title' => $request->validated('title'),
                'comment' => $request->validated('comment'),
            ]);

            /** @var \App\Models\User $user */
            $user = auth()->user();
            $user->increment('luxe_points', 50);
        });

        return back()->with('status', 'Review berhasil dikirim dan Anda mendapatkan 50 Luxe Points!');
    }
}
