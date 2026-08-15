<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use App\Models\VendorWallet;
use Illuminate\Database\Seeder;

class VendorWalletSeeder extends Seeder
{
    public function run(): void
    {
        // Create or find vendor user
        $vendor = User::firstOrCreate(
            ['email' => 'vendor@indonesialuxe.test'],
            [
                'name' => 'Indonesia Luxe Vendor',
                'role' => UserRole::Vendor,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'phone' => '+6281234567890',
                'country' => 'Indonesia',
            ]
        );

        // Create vendor profile
        $vendorProfile = VendorProfile::firstOrCreate(
            ['user_id' => $vendor->id],
            [
                'status' => VendorStatus::Approved,
                'business_name' => 'Indonesia Luxe Travel',
                'business_description' => 'Premium travel experiences across Indonesia',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta',
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_name' => 'Indonesia Luxe Travel',
                'bank_account_number' => '1234567890',
                'approved_at' => now(),
            ]
        );

        // Create wallet
        $wallet = VendorWallet::firstOrCreate(
            ['user_id' => $vendor->id],
            [
                'balance' => 0,
                'total_earned' => 0,
                'total_withdrawn' => 0,
            ]
        );

        // Create tour category if not exists
        $category = TourCategory::firstOrCreate(
            ['name' => 'Adventure'],
            [
                'slug' => 'adventure',
                'description' => 'Adventure tours and activities',
            ]
        );

        // Create tour packages
        $packages = [
            [
                'title' => 'Bali Volcano Hiking Adventure',
                'price_per_person' => 1500000,
                'description' => 'Experience the thrill of hiking Mount Batur at sunrise',
            ],
            [
                'title' => 'Komodo Island Explorer',
                'price_per_person' => 2500000,
                'description' => 'Discover the legendary Komodo dragons in their natural habitat',
            ],
            [
                'title' => 'Raja Ampat Diving Experience',
                'price_per_person' => 3500000,
                'description' => 'World-class diving in the heart of marine biodiversity',
            ],
        ];

        $tourPackages = [];
        foreach ($packages as $packageData) {
            $tourPackages[] = TourPackage::firstOrCreate(
                [
                    'vendor_id' => $vendor->id,
                    'title' => $packageData['title'],
                ],
                [
                    'tour_category_id' => $category->id,
                    'status' => \App\Enums\PackageStatus::Published,
                    'type' => \App\Enums\PackageType::OpenTrip,
                    'slug' => \Illuminate\Support\Str::slug($packageData['title']),
                    'description' => $packageData['description'],
                    'meeting_point' => 'Hotel Lobby',
                    'duration_hours' => 8,
                    'max_participants' => 10,
                    'price_per_person' => $packageData['price_per_person'],
                    'is_active' => true,
                    'approved_at' => now(),
                ]
            );
        }

        // Create customers
        $customers = [];
        for ($i = 1; $i <= 5; $i++) {
            $customers[] = User::firstOrCreate(
                ['email' => "customer{$i}@indonesialuxe.test"],
                [
                    'name' => "Customer {$i}",
                    'role' => UserRole::Customer,
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'phone' => "+628123456789{$i}",
                    'country' => 'Indonesia',
                ]
            );
        }

        // Create orders and bookings with earnings
        $bookingData = [
            [
                'customer' => $customers[0],
                'package' => $tourPackages[0],
                'quantity' => 2,
                'status' => BookingStatus::Confirmed,
                'date' => now()->subDays(30),
            ],
            [
                'customer' => $customers[1],
                'package' => $tourPackages[1],
                'quantity' => 1,
                'status' => BookingStatus::Confirmed,
                'date' => now()->subDays(25),
            ],
            [
                'customer' => $customers[2],
                'package' => $tourPackages[2],
                'quantity' => 2,
                'status' => BookingStatus::Confirmed,
                'date' => now()->subDays(20),
            ],
            [
                'customer' => $customers[3],
                'package' => $tourPackages[0],
                'quantity' => 4,
                'status' => BookingStatus::Confirmed,
                'date' => now()->subDays(15),
            ],
            [
                'customer' => $customers[4],
                'package' => $tourPackages[1],
                'quantity' => 2,
                'status' => BookingStatus::Completed,
                'date' => now()->subDays(10),
            ],
        ];

        foreach ($bookingData as $data) {
            $lineTotal = $data['quantity'] * $data['package']->price_per_person;

            // Create order
            $order = Order::create([
                'code' => 'ORD-'.strtoupper(\Illuminate\Support\Str::random(8)),
                'user_id' => $data['customer']->id,
                'status' => \App\Enums\OrderStatus::Paid,
                'total_amount' => $lineTotal,
                'paid_at' => $data['date'],
            ]);

            // Create order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'vendor_id' => $vendor->id,
                'tour_package_id' => $data['package']->id,
                'package_title' => $data['package']->title,
                'departure_date' => $data['date']->addDays(7),
                'quantity' => $data['quantity'],
                'price_per_person' => $data['package']->price_per_person,
                'line_total' => $lineTotal,
            ]);

            // Create booking
            $booking = Booking::create([
                'order_item_id' => $orderItem->id,
                'user_id' => $data['customer']->id,
                'vendor_id' => $vendor->id,
                'tour_package_id' => $data['package']->id,
                'status' => $data['status'],
                'confirmed_at' => $data['date'],
                'completed_at' => $data['status'] === BookingStatus::Completed ? $data['date']->addDays(7) : null,
            ]);

            // Add earning to wallet (80% of line total)
            $vendorEarning = $lineTotal * 0.8;
            $wallet->addEarning(
                amount: $vendorEarning,
                bookingId: $booking->id,
                description: "Penghasilan dari booking {$data['package']->title} - {$data['quantity']} pax"
            );
        }

        // Add some manual earnings for variety
        $wallet->addEarning(
            amount: 500000,
            description: 'Bonus performance bulan ini'
        );

        $wallet->addEarning(
            amount: 250000,
            description: 'Komisi referral vendor baru'
        );

        $this->command->info('Vendor wallet seeder completed successfully!');
        $this->command->info("Vendor: {$vendor->name} ({$vendor->email})");
        $this->command->info('Final Wallet Balance: Rp '.number_format($wallet->fresh()->balance, 0, ',', '.'));
        $this->command->info('Total Earned: Rp '.number_format($wallet->fresh()->total_earned, 0, ',', '.'));
        $this->command->info('Total Transactions: '.$wallet->transactions()->count());
    }
}
