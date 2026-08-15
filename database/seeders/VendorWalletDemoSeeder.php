<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Models\User;
use App\Models\VendorProfile;
use App\Models\VendorWallet;
use Illuminate\Database\Seeder;

class VendorWalletDemoSeeder extends Seeder
{
    /**
     * Seed demo wallet data for vendor@indonesialuxe.test
     */
    public function run(): void
    {
        // Find or create the specific vendor
        $vendor = User::firstOrCreate(
            ['email' => 'vendor@indonesialuxe.test'],
            [
                'name' => 'Demo Vendor Indonesia Luxe',
                'role' => UserRole::Vendor,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'phone' => '+6281234567890',
                'country' => 'Indonesia',
                'title' => 'Mr.',
                'date_of_birth' => '1985-01-15',
            ]
        );

        // Create or update vendor profile
        VendorProfile::updateOrCreate(
            ['user_id' => $vendor->id],
            [
                'status' => VendorStatus::Approved,
                'business_name' => 'Indonesia Luxe Demo Travel',
                'business_description' => 'Premium travel experiences and adventure tours across Indonesia. Specializing in cultural immersion, nature adventures, and luxury accommodations.',
                'address' => 'Jl. Sudirman Kav. 52-53, SCBD, Jakarta Selatan 12190, Indonesia',
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_name' => 'Indonesia Luxe Demo Travel',
                'bank_account_number' => '1234567890',
                'approved_at' => now()->subDays(30),
            ]
        );

        // Create or get wallet
        $wallet = VendorWallet::firstOrCreate(
            ['user_id' => $vendor->id],
            [
                'balance' => 0,
                'total_earned' => 0,
                'total_withdrawn' => 0,
            ]
        );

        // Add some demo transactions if wallet is empty
        if ($wallet->transactions()->count() === 0) {
            // Add earnings from different time periods
            $earnings = [
                ['amount' => 2400000, 'description' => 'Penghasilan dari Bali Cultural Tour - 2 pax', 'days_ago' => 30],
                ['amount' => 4000000, 'description' => 'Penghasilan dari Komodo Adventure - 2 pax', 'days_ago' => 25],
                ['amount' => 5600000, 'description' => 'Penghasilan dari Raja Ampat Diving - 2 pax', 'days_ago' => 20],
                ['amount' => 6000000, 'description' => 'Penghasilan dari Mount Bromo Sunrise - 4 pax', 'days_ago' => 15],
                ['amount' => 4000000, 'description' => 'Penghasilan dari Yogyakarta Heritage - 2 pax', 'days_ago' => 10],
                ['amount' => 1200000, 'description' => 'Penghasilan dari Borobudur Temple Tour - 1 pax', 'days_ago' => 7],
                ['amount' => 800000, 'description' => 'Bonus performance bulan ini', 'days_ago' => 5],
                ['amount' => 500000, 'description' => 'Komisi referral vendor baru', 'days_ago' => 3],
            ];

            foreach ($earnings as $earning) {
                $wallet->addEarning(
                    amount: $earning['amount'],
                    description: $earning['description']
                );

                // Update created_at to simulate different dates
                $wallet->transactions()->latest()->first()->update([
                    'created_at' => now()->subDays($earning['days_ago']),
                    'updated_at' => now()->subDays($earning['days_ago']),
                ]);
            }

            // Simulate a withdrawal
            $withdrawalAmount = 5000000;
            $wallet->decrement('balance', $withdrawalAmount);
            $wallet->increment('total_withdrawn', $withdrawalAmount);

            $wallet->transactions()->create([
                'type' => 'withdrawal',
                'amount' => $withdrawalAmount,
                'description' => 'Penarikan dana ke rekening BCA',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ]);
        }

        $wallet->refresh();

        $this->command->info('Demo wallet seeder completed successfully!');
        $this->command->info("Vendor: {$vendor->name} ({$vendor->email})");
        $this->command->info('Wallet Balance: Rp '.number_format($wallet->balance, 0, ',', '.'));
        $this->command->info('Total Earned: Rp '.number_format($wallet->total_earned, 0, ',', '.'));
        $this->command->info('Total Withdrawn: Rp '.number_format($wallet->total_withdrawn, 0, ',', '.'));
        $this->command->info('Total Transactions: '.$wallet->transactions()->count());

        $this->command->info("\nLogin credentials:");
        $this->command->info('Email: vendor@indonesialuxe.test');
        $this->command->info('Password: password');
    }
}
