<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorWallet;
use Illuminate\Database\Seeder;

class WalletTestSeeder extends Seeder
{
    public function run(): void
    {
        // Find or create a vendor user
        $vendor = User::where('role', UserRole::Vendor)->first();

        if (! $vendor) {
            $vendor = User::factory()->create([
                'role' => UserRole::Vendor,
                'name' => 'Test Vendor',
                'email' => 'vendor@test.com',
            ]);
        }

        // Create wallet for vendor
        $wallet = VendorWallet::firstOrCreate([
            'user_id' => $vendor->id,
        ]);

        // Create some test tour packages
        $tourPackage = TourPackage::factory()->create([
            'vendor_id' => $vendor->id,
            'title' => 'Bali Adventure Tour',
            'price_per_person' => 1000000,
        ]);

        // Create customer
        $customer = User::factory()->create([
            'role' => UserRole::Customer,
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
        ]);

        // Create order and order items
        $order = Order::factory()->create([
            'user_id' => $customer->id,
            'total_amount' => 2000000,
        ]);

        $orderItem = OrderItem::factory()->create([
            'order_id' => $order->id,
            'vendor_id' => $vendor->id,
            'tour_package_id' => $tourPackage->id,
            'package_title' => $tourPackage->title,
            'quantity' => 2,
            'price_per_person' => 1000000,
            'line_total' => 2000000,
        ]);

        // Create confirmed booking to trigger wallet earning
        $booking = Booking::factory()->create([
            'order_item_id' => $orderItem->id,
            'user_id' => $customer->id,
            'vendor_id' => $vendor->id,
            'tour_package_id' => $tourPackage->id,
            'status' => BookingStatus::Confirmed,
            'confirmed_at' => now(),
        ]);

        // Manually add earning since observer might not trigger in seeder
        $vendorEarning = $orderItem->line_total * 0.8; // 80% = 1,600,000

        $wallet->addEarning(
            amount: $vendorEarning,
            bookingId: $booking->id,
            description: "Penghasilan dari booking {$orderItem->package_title}"
        );

        // Add another transaction for variety
        $wallet->addEarning(
            amount: 500000,
            description: 'Bonus penghasilan'
        );

        $this->command->info('Wallet test data created successfully!');
        $this->command->info("Vendor: {$vendor->name} ({$vendor->email})");
        $this->command->info('Wallet Balance: Rp '.number_format($wallet->fresh()->balance, 0, ',', '.'));
    }
}
