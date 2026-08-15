<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourDepartureSlot;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function __construct(private readonly CartService $cartService) {}

    public function checkout(User $user, ?string $notes = null, array $itemIds = null, array $paymentData = []): Order
    {
        $cart = $this->cartService->loadCart($user);
        $items = $cart->items;

        if ($itemIds !== null) {
            $items = $items->whereIn('id', $itemIds);
        }

        if ($items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Item yang dipilih tidak tersedia atau keranjang kosong.',
            ]);
        }

        return DB::transaction(function () use ($cart, $items, $user, $notes, $paymentData): Order {
            $order = Order::query()->create([
                'code' => $this->generateOrderCode(),
                'user_id' => $user->id,
                'status' => !empty($paymentData['proof_path']) ? OrderStatus::AwaitingValidation : OrderStatus::PendingPayment,
                'total_amount' => $items->sum('line_total'),
                'payment_due_at' => now()->addDay(),
                'notes' => $notes,
            ]);

            if (!empty($paymentData)) {
                $order->paymentSubmissions()->create([
                    'submitted_by_user_id' => $user->id,
                    'status' => \App\Enums\PaymentValidationStatus::Pending,
                    'proof_path' => $paymentData['proof_path'] ?? null,
                    'bank_sender_name' => $paymentData['bank_sender_name'] ?? null,
                    'bank_sender_account' => $paymentData['bank_sender_account'] ?? null,
                    'notes' => $paymentData['notes'] ?? null,
                ]);
            }

            foreach ($items as $item) {
                /** @var TourDepartureSlot $slot */
                $slot = TourDepartureSlot::query()->whereKey($item->tour_departure_slot_id)->lockForUpdate()->firstOrFail();
                $tourPackage = $slot->tourPackage;

                if ($tourPackage->status !== PackageStatus::Published) {
                    throw ValidationException::withMessages([
                        'cart' => sprintf('Paket %s belum tersedia.', $tourPackage->title),
                    ]);
                }

                if ($slot->availableQuota() < $item->quantity) {
                    throw ValidationException::withMessages([
                        'cart' => sprintf('Kuota slot %s tidak mencukupi.', $tourPackage->title),
                    ]);
                }

                $slot->booked_count += $item->quantity;
                $slot->save();

                $orderItem = OrderItem::query()->create([
                    'order_id' => $order->id,
                    'vendor_id' => $tourPackage->vendor_id,
                    'tour_package_id' => $tourPackage->id,
                    'tour_departure_slot_id' => $slot->id,
                    'package_title' => $tourPackage->title,
                    'departure_date' => $slot->departure_date,
                    'quantity' => $item->quantity,
                    'price_per_person' => $item->price_per_person,
                    'line_total' => $item->line_total,
                    'status' => BookingStatus::Pending,
                    'pickup_point' => $item->pickup_point,
                ]);

                Booking::query()->create([
                    'order_item_id' => $orderItem->id,
                    'user_id' => $user->id,
                    'vendor_id' => $tourPackage->vendor_id,
                    'tour_package_id' => $tourPackage->id,
                    'status' => BookingStatus::Pending,
                ]);
            }

            $this->cartService->clearCart($cart);

            return $order->load(['items.tourPackage.category', 'paymentSubmissions']);
        });
    }

    private function generateOrderCode(): string
    {
        return 'ILX-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
    }
}
