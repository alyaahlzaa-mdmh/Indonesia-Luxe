<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentSubmissionRequest;
use App\Models\Order;
use App\Services\PaymentSubmissionService;

class PaymentSubmissionController extends Controller
{
    public function __construct(private readonly PaymentSubmissionService $paymentSubmissionService)
    {
    }

    public function create(Order $order)
    {
        $this->authorize('view', $order);

        return view('payments.create', [
            'order' => $order->load('items'),
        ]);
    }

    public function store(StorePaymentSubmissionRequest $request, Order $order)
    {
        $this->authorize('view', $order);

        $this->paymentSubmissionService->submit(
            $order,
            auth()->user(),
            $request->file('proof'),
            $request->validated(),
        );

        return redirect()->route('orders.show', $order)->with('status', 'Bukti pembayaran berhasil dikirim.');
    }
}
