<?php

namespace App\Http\Controllers;

use App\Models\Order;

class UserBookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with([
                'orderItem.order.paymentSubmissions' => fn ($query) => $query->latest(),
                'orderItem.tourPackage.vendor',
                'review',
            ])
            ->latest()
            ->paginate(15);

        return view('bookings.index', [
            'bookings' => $bookings,
        ]);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.show', [
            'order' => $order->load([
                'items.tourPackage',
                'paymentSubmissions' => fn ($query) => $query->latest(),
            ]),
        ]);
    }
}
