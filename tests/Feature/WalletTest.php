<?php

namespace Tests\Feature;

use App\Enums\BookingStatus;
use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorWallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendor_wallet_is_created_automatically(): void
    {
        $vendor = User::factory()->create(['role' => UserRole::Vendor]);

        // Create vendor profile (required by middleware)
        $vendor->vendorProfile()->create([
            'status' => \App\Enums\VendorStatus::Approved,
            'business_name' => 'Test Business',
            'business_description' => 'Test Description',
            'address' => 'Test Address',
            'bank_name' => 'Test Bank',
            'bank_account_name' => 'Test Account',
            'bank_account_number' => '1234567890',
            'approved_at' => now(),
        ]);

        $this->actingAs($vendor);

        $response = $this->get(route('vendor.wallet.index'));

        $response->assertOk();
        $this->assertDatabaseHas('vendor_wallets', [
            'user_id' => $vendor->id,
            'balance' => 0,
        ]);
    }

    public function test_vendor_earns_money_when_booking_confirmed(): void
    {
        $vendor = User::factory()->create(['role' => UserRole::Vendor]);
        $customer = User::factory()->create(['role' => UserRole::Customer]);

        $tourPackage = TourPackage::factory()->create([
            'vendor_id' => $vendor->id,
        ]);

        $order = Order::factory()->create(['user_id' => $customer->id]);

        $orderItem = OrderItem::factory()->create([
            'order_id' => $order->id,
            'vendor_id' => $vendor->id,
            'tour_package_id' => $tourPackage->id,
            'line_total' => 1000000, // 1 million
        ]);

        $booking = Booking::factory()->create([
            'order_item_id' => $orderItem->id,
            'user_id' => $customer->id,
            'vendor_id' => $vendor->id,
            'tour_package_id' => $tourPackage->id,
            'status' => BookingStatus::Pending,
        ]);

        // Confirm the booking
        $booking->update(['status' => BookingStatus::Confirmed]);

        // Check wallet balance (should be 80% of 1,000,000 = 800,000)
        $wallet = VendorWallet::where('user_id', $vendor->id)->first();
        $this->assertEquals(800000, $wallet->balance);
        $this->assertEquals(800000, $wallet->total_earned);

        // Check transaction record
        $this->assertDatabaseHas('wallet_transactions', [
            'vendor_wallet_id' => $wallet->id,
            'type' => 'earning',
            'amount' => 800000,
            'booking_id' => $booking->id,
        ]);
    }

    public function test_wallet_page_displays_correct_data(): void
    {
        $vendor = User::factory()->create(['role' => UserRole::Vendor]);

        // Create vendor profile (required by middleware)
        $vendor->vendorProfile()->create([
            'status' => \App\Enums\VendorStatus::Approved,
            'business_name' => 'Test Business',
            'business_description' => 'Test Description',
            'address' => 'Test Address',
            'bank_name' => 'Test Bank',
            'bank_account_name' => 'Test Account',
            'bank_account_number' => '1234567890',
            'approved_at' => now(),
        ]);

        // Create wallet with some balance
        $wallet = VendorWallet::factory()->create([
            'user_id' => $vendor->id,
            'balance' => 500000,
            'total_earned' => 1000000,
            'total_withdrawn' => 500000,
        ]);

        $this->actingAs($vendor);

        $response = $this->get(route('vendor.wallet.index'));

        $response->assertOk()
            ->assertSee('500.000') // balance
            ->assertSee('1.000.000') // total earned
            ->assertSee('500.000'); // total withdrawn
    }

    public function test_vendor_can_withdraw_funds(): void
    {
        $vendor = User::factory()->create(['role' => UserRole::Vendor]);

        // Create vendor profile
        $vendor->vendorProfile()->create([
            'status' => \App\Enums\VendorStatus::Approved,
            'business_name' => 'Test Business',
            'business_description' => 'Test Description',
            'address' => 'Test Address',
            'bank_name' => 'Test Bank',
            'bank_account_name' => 'Test Account',
            'bank_account_number' => '1234567890',
            'approved_at' => now(),
        ]);

        // Create wallet with sufficient balance
        $wallet = VendorWallet::factory()->create([
            'user_id' => $vendor->id,
            'balance' => 1000000, // 1 million
            'total_earned' => 1000000,
            'total_withdrawn' => 0,
        ]);

        $this->actingAs($vendor);

        $withdrawalData = [
            'amount' => 500000,
            'bank_name' => 'Bank Central Asia (BCA)',
            'bank_account_name' => 'Test Vendor',
            'bank_account_number' => '9876543210',
            'notes' => 'Test withdrawal',
        ];

        $response = $this->post(route('vendor.wallet.withdraw'), $withdrawalData);

        $response->assertRedirect()
            ->assertSessionHas('success');

        // Check wallet balance updated
        $wallet->refresh();
        $this->assertEquals(500000, $wallet->balance);
        $this->assertEquals(500000, $wallet->total_withdrawn);

        // Check withdrawal record created
        $this->assertDatabaseHas('wallet_withdrawals', [
            'vendor_wallet_id' => $wallet->id,
            'amount' => 500000,
            'status' => 'pending',
        ]);

        // Check transaction record created
        $this->assertDatabaseHas('wallet_transactions', [
            'vendor_wallet_id' => $wallet->id,
            'type' => 'withdrawal',
            'amount' => 500000,
        ]);
    }

    public function test_vendor_cannot_withdraw_more_than_balance(): void
    {
        $vendor = User::factory()->create(['role' => UserRole::Vendor]);

        // Create vendor profile
        $vendor->vendorProfile()->create([
            'status' => \App\Enums\VendorStatus::Approved,
            'business_name' => 'Test Business',
            'business_description' => 'Test Description',
            'address' => 'Test Address',
            'bank_name' => 'Test Bank',
            'bank_account_name' => 'Test Account',
            'bank_account_number' => '1234567890',
            'approved_at' => now(),
        ]);

        // Create wallet with low balance
        $wallet = VendorWallet::factory()->create([
            'user_id' => $vendor->id,
            'balance' => 100000, // 100k
            'total_earned' => 100000,
            'total_withdrawn' => 0,
        ]);

        $this->actingAs($vendor);

        $withdrawalData = [
            'amount' => 500000, // More than balance
            'bank_name' => 'Bank Central Asia (BCA)',
            'bank_account_name' => 'Test Vendor',
            'bank_account_number' => '9876543210',
        ];

        $response = $this->post(route('vendor.wallet.withdraw'), $withdrawalData);

        $response->assertSessionHasErrors(['amount']);

        // Check wallet balance unchanged
        $wallet->refresh();
        $this->assertEquals(100000, $wallet->balance);
    }
}
