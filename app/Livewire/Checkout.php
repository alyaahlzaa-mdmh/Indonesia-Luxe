<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\User;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Checkout extends Component
{
    use WithFileUploads;

    public int $step = 1;

    // Form fields — only scalars, safe to serialize
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $note = '';

    public $proof;

    // Store only IDs, not Eloquent models/Collections
    public array $selectedIds = [];

    public array $pickupPoints = [];

    public float $subtotal = 0;

    // After booking: store the order ID
    public ?int $orderId = null;

    public string $whatsappUrl = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string|max:1000',
            'proof' => 'nullable|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ];
    }

    public function mount(Collection $cartItems, array $selectedIds = []): void
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user) {
            $this->name = $user->name ?? '';
            $this->email = $user->email ?? '';
            $this->phone = $this->formattedPhone($user->phone ?? '');
        }

        // Store only IDs — never store Eloquent models/Collections as Livewire props
        $this->selectedIds = $cartItems->pluck('id')->map(fn ($id) => (int) $id)->toArray();
        $this->subtotal = (float) $cartItems->sum('line_total');

        // Initialize pickup points from cart items
        foreach ($cartItems as $item) {
            $this->pickupPoints[$item->id] = $item->pickup_point ?? '';
        }
    }

    /** Lazily fetch cart items fresh from DB for the current render. */
    public function getSelectedItemsProperty(): Collection
    {
        return app(CartService::class)
            ->loadCart(auth()->user())
            ->items
            ->when(
                ! empty($this->selectedIds),
                fn ($items) => $items->whereIn('id', $this->selectedIds)
            );
    }

    /** Lazily fetch the created order (only after booking). */
    public function getOrderProperty(): ?Order
    {
        if (! $this->orderId) {
            return null;
        }

        return Order::with(['items.tourPackage.category'])->find($this->orderId);
    }

    /** Normalizes the phone number to '08xxx' format for local display. */
    public function getPhoneForDisplayProperty(): string
    {
        $digits = preg_replace('/\D/', '', $this->phone);
        if (empty($digits)) {
            return '';
        }

        // Ensure it starts with '0' if it doesn't already
        if (str_starts_with($digits, '62')) {
            $digits = '0'.substr($digits, 2);
        }
        if (! str_starts_with($digits, '0')) {
            $digits = '0'.$digits;
        }

        return $digits;
    }

    public function formattedPhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);
        if (str_starts_with($phone, '62')) {
            $phone = substr($phone, 2);
        }
        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }

        return $phone;
    }

    public function nextStep(): void
    {
        if ($this->step === 1) {
            // Only validate contact fields — proof is optional and validated at submit
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'note' => 'nullable|string|max:1000',
            ]);
        }
        $this->step++;
    }

    public function previousStep(): void
    {
        $this->step--;
    }

    /** Clear the proof file. */
    public function removeProof(): void
    {
        $this->proof = null;
    }

    public function submitBooking(CheckoutService $checkoutService): void
    {
        $this->validate();

        /** @var User $user */
        $user = auth()->user();

        $paymentData = [];
        if ($this->proof) {
            $paymentData = [
                'proof_path' => $this->proof ? $this->proof->store('payment-proofs', 'public') : null,
            ];
        }

        // Save updated pickup points back to CartItems
        foreach ($this->pickupPoints as $itemId => $pickupPoint) {
            \App\Models\CartItem::query()
                ->whereKey($itemId)
                ->update(['pickup_point' => $pickupPoint]);
        }

        // Create the order via CheckoutService
        $order = $checkoutService->checkout(
            $user,
            $this->note ?: null,
            ! empty($this->selectedIds) ? $this->selectedIds : null,
            $paymentData
        );

        // Store only the ID — never the full model
        $this->orderId = $order->id;

        // Build and store the WhatsApp URL
        $this->whatsappUrl = $this->buildWhatsappUrl($order);

        // Toast notification — dispatch to window
        $this->dispatch('toast', message: 'Pesanan berhasil dibuat! Silakan hubungi CS melalui WhatsApp.');

        // Open WhatsApp in new tab
        $this->dispatch('open-whatsapp', url: $this->whatsappUrl);

        // Advance to step 3
        $this->step = 3;
    }

    private function buildWhatsappUrl(Order $order): string
    {
        $adminPhone = getAdminWhatsapp();

        $msg = "Halo *Indonesia Luxe Travel*! 👋\n\n";
        $msg .= "Saya ingin melakukan pemesanan dengan detail berikut:\n\n";
        $msg .= "━━━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "👤 *DATA PEMESAN*\n";
        $msg .= "   Nama         : {$this->name}\n";
        $msg .= "   Email          : {$this->email}\n";
        $msg .= "   WhatsApp : {$this->phone_for_display}\n\n";

        $count = $order->items->count();
        $msg .= "━━━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "🗒️ *DETAIL PESANAN ({$count} paket)*\n\n";

        foreach ($order->items as $index => $item) {
            $num = $index + 1;
            $category = $item->tourPackage->category->name ?? '-';
            $date = $item->departure_date instanceof \Carbon\Carbon
              ? $item->departure_date->format('Y-m-d')
              : \Carbon\Carbon::parse($item->departure_date)->format('Y-m-d');
            $priceText = 'Rp '.number_format((float) $item->price_per_person, 0, ',', '.');
            $subtotalText = 'Rp '.number_format((float) $item->line_total, 0, ',', '.');

            $msg .= "   {$num}. *{$item->package_title}*\n";
            $msg .= "      🏷️ Kategori    : {$category}\n";
            $msg .= "      📅 Tanggal     : {$date}\n";
            $msg .= "      👥 Peserta      : {$item->quantity} orang\n";
            if ($item->pickup_point) {
                $msg .= "      📍 Titik Jemput : {$item->pickup_point}\n";
            }
            $msg .= "      💵 Harga/org : {$priceText}\n";
            $msg .= "      💰 Subtotal     : {$subtotalText}\n\n";
        }

        $totalText = 'Rp '.number_format((float) $order->total_amount, 0, ',', '.');
        $msg .= "━━━━━━━━━━━━━━━━━━━━━━\n";
        $msg .= "💳 *DETAIL TRANSAKSI*\n";
        $msg .= "   Subtotal                   : {$totalText}\n";
        $msg .= "   *Total Pembayaran  : {$totalText}*\n\n";
        $msg .= "━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $msg .= "📍 *No. Order: {$order->code}*\n\n";
        $msg .= 'Mohon konfirmasi ketersediaan dan pembayaran. Terima kasih!';

        return 'https://api.whatsapp.com/send/?phone='.$adminPhone
          .'&text='.urlencode($msg)
          .'&type=phone_number&app_absent=0';
    }

    public function render()
    {
        return view('livewire.checkout', [
            'selectedItems' => $this->selectedItems,
            'order' => $this->order,
        ]);
    }
}
