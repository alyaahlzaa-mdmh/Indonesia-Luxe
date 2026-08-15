<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentValidationStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSubmission;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get some customers and packages for context
        $customers = User::where('role', 'customer')->take(3)->get();
        if ($customers->isEmpty()) {
            $customers = User::factory()->count(3)->create(['role' => 'customer']);
        }

        $packages = TourPackage::where('status', 'published')->take(3)->get();
        if ($packages->isEmpty()) {
            $packages = TourPackage::factory()->count(3)->create(['status' => 'published']);
        }

        $banks = ['BCA', 'Mandiri', 'BNI', 'BRI'];

        // Define 3 different payment scenarios
        $scenarios = [
            [
                'customer' => $customers[0],
                'status' => PaymentValidationStatus::Pending,
                'bank' => 'BCA',
                'sender' => $customers[0]->name,
                'amount' => 1250000,
            ],
            [
                'customer' => $customers[1] ?? $customers[0],
                'status' => PaymentValidationStatus::Approved,
                'bank' => 'Mandiri',
                'sender' => ($customers[1] ?? $customers[0])->name,
                'amount' => 450000,
            ],
            [
                'customer' => $customers[2] ?? $customers[0],
                'status' => PaymentValidationStatus::Rejected,
                'bank' => 'BNI',
                'sender' => 'Budi Setiawan', // Different name
                'amount' => 8900000,
            ],
        ];

        foreach ($scenarios as $index => $data) {
            // Create Order first
            $order = Order::create([
                'code' => 'ORD-'.strtoupper(Str::random(8)),
                'user_id' => $data['customer']->id,
                'status' => $data['status'] === PaymentValidationStatus::Approved ? OrderStatus::Paid : OrderStatus::PendingPayment,
                'total_amount' => $data['amount'],
                'payment_due_at' => now()->addDays(1),
                'paid_at' => $data['status'] === PaymentValidationStatus::Approved ? now() : null,
            ]);

            // Create Order Item
            $pkg = $packages[$index % count($packages)];
            OrderItem::create([
                'order_id' => $order->id,
                'vendor_id' => $pkg->vendor_id,
                'tour_package_id' => $pkg->id,
                'package_title' => $pkg->title,
                'departure_date' => now()->addWeeks(2),
                'quantity' => 1,
                'price_per_person' => $data['amount'],
                'line_total' => $data['amount'],
                'status' => $data['status'] === PaymentValidationStatus::Approved ? BookingStatus::Confirmed : BookingStatus::Pending,
            ]);

            // Create Payment Submission
            PaymentSubmission::create([
                'order_id' => $order->id,
                'submitted_by_user_id' => $data['customer']->id,
                'status' => $data['status'],
                'proof_path' => 'proofs/dummy.jpg', // Dummy string to avoid null constraint
                'bank_sender_name' => $data['bank'],
                'bank_sender_account' => rand(100000000, 999999999),
                'notes' => 'Pembayaran untuk order '.$order->code,
                'rejection_reason' => $data['status'] === PaymentValidationStatus::Rejected ? 'Bukti transfer tidak terbaca (blur).' : null,
                'validated_at' => $data['status'] !== PaymentValidationStatus::Pending ? now() : null,
                'validated_by_user_id' => $data['status'] !== PaymentValidationStatus::Pending ? User::where('role', 'admin')->first()?->id : null,
            ]);
        }
    }
}
