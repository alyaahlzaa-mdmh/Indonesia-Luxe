<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Services\CartService;
use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly CheckoutService $checkoutService,
    ) {}

    public function formattedPhone(string $phone): string
    {
        // 1. Ambil hanya angka
        $phone = preg_replace('/\D/', '', $phone);

        // 2. Jika diawali 62 → hapus 62
        if (str_starts_with($phone, '62')) {
            $phone = substr($phone, 2);
        }

        // 3. Jika masih diawali 0 → hapus 0
        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }

        return $phone;
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cart = $this->cartService->loadCart($user);
        $ids  = request()->input('ids');

        // Cast to int array so Livewire handles the type consistently
        $selectedIds = $ids ? array_map('intval', (array) $ids) : [];

        if ($selectedIds) {
            $cart->setRelation('items', $cart->items->whereIn('id', $selectedIds));
        }

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Silakan pilih minimal 1 item untuk checkout.');
        }

        return view('checkout.create', [
            'user'        => $user,
            'cart'        => $cart,
            'selectedIds' => $selectedIds,
        ]);
    }

    public function store(StoreCheckoutRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $order = $this->checkoutService->checkout(
            $user,
            $request->validated('notes'),
            $request->input('ids'),
        );

        return redirect()->route('orders.show', $order)->with('status', 'Checkout berhasil. Silakan upload bukti pembayaran.');
    }
}
