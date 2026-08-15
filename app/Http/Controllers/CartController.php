<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;
use App\Models\TourDepartureSlot;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService) {}

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cart = $this->cartService->loadCart($user);

        return view('cart.index', [
            'cart' => $cart,
            'subtotal' => $this->cartService->calculateSubtotal($cart),
        ]);
    }

    public function store(StoreCartItemRequest $request)
    {
        $slot = TourDepartureSlot::query()->with('tourPackage')->findOrFail($request->integer('tour_departure_slot_id'));
        $pickupPoint = $this->normalizePickupPoint($request->input('pickup_point'));

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cart = $this->cartService->addItem($user, $slot, $request->integer('quantity'), $pickupPoint);

        if ($request->input('redirect_to') === 'checkout') {
            $cartItem = $cart->items->first(function (CartItem $item) use ($slot, $pickupPoint): bool {
                return $item->tour_departure_slot_id === $slot->id
                    && (string) $item->pickup_point === $pickupPoint;
            });

            if ($cartItem !== null) {
                return redirect()->route('checkout.create', ['ids' => [$cartItem->id]]);
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Item berhasil ditambahkan ke keranjang!',
                'cartCount' => $cart->items->count(),
                'totalQuantity' => $cart->items->sum('quantity'),
            ]);
        }

        return back()->with('status', 'Item berhasil ditambahkan ke keranjang!');
    }

    public function update(UpdateCartItemRequest $request, CartItem $cartItem)
    {
        $this->ensureCartOwnership($cartItem);
        $cartItem->load(['slot', 'cart.user']);

        $this->cartService->updateItem($cartItem, $request->integer('quantity'));

        return back()->with('status', 'Item keranjang berhasil diperbarui.');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->ensureCartOwnership($cartItem);
        $this->cartService->removeItem($cartItem);

        return back()->with('status', 'Item berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cart = $this->cartService->getOrCreateCart($user);
        $this->cartService->clearCart($cart);

        return back()->with('status', 'Keranjang berhasil dikosongkan.');
    }

    private function ensureCartOwnership(CartItem $cartItem): void
    {
        /** @var int|string|null $authId */
        $authId = auth()->id();
        if ($cartItem->cart->user_id !== $authId) {
            abort(404);
        }
    }

    private function normalizePickupPoint(?string $pickupPoint): string
    {
        return trim((string) $pickupPoint);
    }
}
