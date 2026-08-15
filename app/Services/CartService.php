<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\TourDepartureSlot;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function getOrCreateCart(User $user): Cart
    {
        return Cart::query()->firstOrCreate(
            ['user_id' => $user->id],
            ['user_id' => $user->id],
        );
    }

    public function loadCart(User $user): Cart
    {
        return $this->getOrCreateCart($user)->load([
            'items.tourPackage.vendor',
            'items.tourPackage.category',
            'items.tourPackage.pickupPoints',
            'items.slot',
        ]);
    }

    public function addItem(User $user, TourDepartureSlot $slot, int $quantity, ?string $pickupPoint = null): Cart
    {
        if ($quantity < 1) {
            throw ValidationException::withMessages([
                'quantity' => 'Quantity harus lebih dari 0.',
            ]);
        }

        $cart = $this->getOrCreateCart($user);
        $pricePerPerson = $slot->price_per_person ?? $slot->tourPackage->price_per_person;
        $normalizedPickupPoint = $this->normalizePickupPoint($pickupPoint);

        $item = CartItem::query()->firstOrNew([
            'cart_id' => $cart->id,
            'tour_departure_slot_id' => $slot->id,
            'pickup_point' => $normalizedPickupPoint,
        ]);

        $item->tour_package_id = $slot->tour_package_id;
        $item->quantity = $item->exists ? $item->quantity + $quantity : $quantity;
        $item->pickup_point = $normalizedPickupPoint;

        $otherSlotQuantity = CartItem::query()
            ->where('cart_id', $cart->id)
            ->where('tour_departure_slot_id', $slot->id)
            ->when($item->exists, fn ($query) => $query->whereKeyNot($item->id))
            ->sum('quantity');

        if ($slot->availableQuota() < $otherSlotQuantity + $item->quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Kuota slot tidak mencukupi.',
            ]);
        }

        $item->price_per_person = $pricePerPerson;
        $item->line_total = $item->quantity * $item->price_per_person;
        $item->save();

        return $this->loadCart($user);
    }

    public function updateItem(CartItem $item, int $quantity): Cart
    {
        if ($quantity < 1) {
            throw ValidationException::withMessages([
                'quantity' => 'Quantity harus lebih dari 0.',
            ]);
        }

        $otherSlotQuantity = CartItem::query()
            ->where('cart_id', $item->cart_id)
            ->where('tour_departure_slot_id', $item->tour_departure_slot_id)
            ->whereKeyNot($item->id)
            ->sum('quantity');

        if ($item->slot->availableQuota() < $otherSlotQuantity + $quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Kuota slot tidak mencukupi.',
            ]);
        }

        $item->quantity = $quantity;
        $item->line_total = (string) ($item->quantity * (float) $item->price_per_person);
        $item->save();

        return $this->loadCart($item->cart->user);
    }

    public function removeItem(CartItem $item): void
    {
        $item->delete();
    }

    public function clearCart(Cart $cart): void
    {
        $cart->items()->delete();
    }

    public function calculateSubtotal(Cart $cart): float
    {
        return (float) $cart->items()->sum('line_total');
    }

    private function normalizePickupPoint(?string $pickupPoint): string
    {
        return trim((string) $pickupPoint);
    }
}
