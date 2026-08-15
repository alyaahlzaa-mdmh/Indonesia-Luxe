<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()
            ->where('vendor_id', auth()->id())
            ->with(['user', 'tourPackage', 'orderItem.order'])
            ->latest()
            ->paginate(20);

        return view('vendor.bookings.index', [
            'bookings' => $bookings,
        ]);
    }
    public function show(Booking $booking)
    {
        $bookingsCount = Booking::query()
            ->where('vendor_id', auth()->id())
            ->count();

        $booking = Booking::query()
            ->where('vendor_id', auth()->id())
            ->where('id', $booking->id)
            ->with(['user', 'tourPackage', 'orderItem.order.paymentSubmissions'])
            ->firstOrFail();

        return view('vendor.bookings.show', [
            'booking' => $booking,
            'bookingsCount' => $bookingsCount,
        ]);
    }

    public function complete(Booking $booking)
    {
        $this->authorize('update', $booking);

        if ($booking->status !== BookingStatus::Confirmed) {
            return back()->withErrors(['booking' => 'Booking belum dalam status confirmed.']);
        }

        $booking->status = BookingStatus::Completed;
        $booking->completed_at = now();
        $booking->save();

        $orderItem = $booking->orderItem;
        $orderItem->status = BookingStatus::Completed;
        $orderItem->save();

        if ($orderItem->order->items()->where('status', '!=', BookingStatus::Completed->value)->doesntExist()) {
            $orderItem->order->status = OrderStatus::Completed;
            $orderItem->order->save();
        }

        return back()->with('status', 'Booking ditandai completed.');
    }
}
