<?php

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentValidationStatus;
use App\Enums\VendorStatus;
use App\Enums\WalletTransactionType;
use App\Enums\WithdrawalStatus;
use App\Livewire\Admin\MonthlyReport;
use App\Livewire\Admin\PackageManagement;
use App\Livewire\Admin\PaymentValidation;
use App\Livewire\Admin\VendorManagement;
use App\Livewire\Admin\WithdrawalManagement;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSubmission;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use App\Models\VendorWallet;
use App\Models\WalletWithdrawal;
use Illuminate\Support\Carbon;
use Livewire\Livewire;

it('admin can approve pending vendor from the livewire page', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();
    $vendorProfile = VendorProfile::factory()->create([
        'user_id' => $vendor->id,
    ]);

    $this->actingAs($admin);

    Livewire::test(VendorManagement::class)
        ->call('confirmApprove', $vendorProfile->id)
        ->call('approve')
        ->assertHasNoErrors();

    expect($vendorProfile->refresh()->status)->toBe(VendorStatus::Approved)
        ->and($vendorProfile->approved_by_user_id)->toBe($admin->id);
});

it('admin can create an internal package with integrated metadata', function () {
    $admin = User::factory()->admin()->create();
    $category = TourCategory::factory()->create();

    $this->actingAs($admin);

    Livewire::test(PackageManagement::class)
        ->call('openCreateForm')
        ->set('title', 'Luxury Flores Escape')
        ->set('type', 'private_tour')
        ->set('tour_category_id', $category->id)
        ->set('meeting_point', 'Labuan Bajo')
        ->set('price', 4500000)
        ->set('duration_days', 4)
        ->set('max_participants', 8)
        ->set('image_url', 'https://example.com/flores.jpg')
        ->set('description', 'Paket internal premium untuk eksplorasi Flores.')
        ->set('highlights', 'Private yacht, Sunset point, Premium dining')
        ->set('included', 'Hotel, Guide, Airport transfer')
        ->call('savePackage')
        ->assertHasNoErrors();

    $package = TourPackage::query()->firstOrFail();

    expect($package->vendor_id)->toBe($admin->id)
        ->and($package->tour_category_id)->toBe($category->id)
        ->and($package->cover_image_path)->toBe('https://example.com/flores.jpg')
        ->and($package->highlights)->toBe([
            'Private yacht',
            'Sunset point',
            'Premium dining',
        ])
        ->and($package->included)->toBe([
            'Hotel',
            'Guide',
            'Airport transfer',
        ]);
});

it('admin can approve a payment from the livewire page', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create([
        'user_id' => $vendor->id,
    ]);

    $category = TourCategory::factory()->create();
    $package = TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
    ]);

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
    ]);

    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Pending,
    ]);

    $booking = Booking::factory()->create([
        'order_item_id' => $orderItem->id,
        'user_id' => $customer->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'status' => BookingStatus::Pending,
    ]);

    $paymentSubmission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Pending,
    ]);

    $this->actingAs($admin);

    Livewire::test(PaymentValidation::class)
        ->call('approve', $paymentSubmission->id)
        ->assertHasNoErrors();

    expect($paymentSubmission->refresh()->status)->toBe(PaymentValidationStatus::Approved)
        ->and($paymentSubmission->validated_by_user_id)->toBe($admin->id)
        ->and($paymentSubmission->validated_at)->not->toBeNull()
        ->and($order->refresh()->status)->toBe(OrderStatus::Paid)
        ->and($order->paid_at)->not->toBeNull()
        ->and($orderItem->refresh()->status)->toBe(BookingStatus::Confirmed)
        ->and($booking->refresh()->status)->toBe(BookingStatus::Confirmed)
        ->and($booking->confirmed_at)->not->toBeNull();
});

it('admin can reject a payment from the livewire page', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
        'paid_at' => null,
    ]);

    $paymentSubmission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Pending,
    ]);

    $this->actingAs($admin);

    Livewire::test(PaymentValidation::class)
        ->call('confirmReject', $paymentSubmission->id)
        ->set('rejectReason', 'Bukti transfer tidak valid.')
        ->call('reject')
        ->assertHasNoErrors();

    expect($paymentSubmission->refresh()->status)->toBe(PaymentValidationStatus::Rejected)
        ->and($paymentSubmission->validated_by_user_id)->toBe($admin->id)
        ->and($paymentSubmission->validated_at)->not->toBeNull()
        ->and($paymentSubmission->rejection_reason)->toBe('Bukti transfer tidak valid.')
        ->and($order->refresh()->status)->toBe(OrderStatus::PendingPayment)
        ->and($order->paid_at)->toBeNull();
});

it('renders payment action buttons with mobile-safe interaction attributes', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();
    $paymentSubmission = PaymentSubmission::factory()->create([
        'submitted_by_user_id' => $customer->id,
    ]);

    $this->actingAs($admin);

    Livewire::test(PaymentValidation::class)
        ->set('expandedPaymentId', $paymentSubmission->id)
        ->assertSeeHtml('wire:click.stop="approve('.$paymentSubmission->id.')"')
        ->assertSeeHtml('wire:click.stop="confirmReject('.$paymentSubmission->id.')"')
        ->assertSeeHtml('type="button"')
        ->assertSeeHtml('touch-manipulation');
});

it('hides payment action buttons when the payment status is final', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();
    $paymentSubmission = PaymentSubmission::factory()->create([
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Approved,
        'validated_by_user_id' => $admin->id,
        'validated_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(PaymentValidation::class)
        ->set('expandedPaymentId', $paymentSubmission->id)
        ->assertDontSeeHtml('wire:click.stop="approve('.$paymentSubmission->id.')"')
        ->assertDontSeeHtml('wire:click.stop="confirmReject('.$paymentSubmission->id.')"')
        ->assertDontSee('Pending')
        ->assertSee('Pembayaran ini sudah disetujui');
});

it('admin can approve a pending withdrawal from the livewire page', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();

    $wallet = VendorWallet::query()->create([
        'user_id' => $vendor->id,
        'balance' => 350000,
        'total_earned' => 850000,
        'total_withdrawn' => 500000,
    ]);

    $withdrawal = WalletWithdrawal::query()->create([
        'vendor_wallet_id' => $wallet->id,
        'amount' => 500000,
        'status' => WithdrawalStatus::Pending,
        'bank_details' => [
            'bank_name' => 'Bank Central Asia',
            'bank_account_name' => 'Vendor Test',
            'bank_account_number' => '1234567890',
        ],
    ]);

    $transaction = $wallet->transactions()->create([
        'type' => WalletTransactionType::Withdrawal,
        'amount' => 500000,
        'description' => 'Penarikan dana ke Bank Central Asia - 1234567890',
        'withdrawal_id' => $withdrawal->id,
    ]);

    $this->actingAs($admin);

    Livewire::test(WithdrawalManagement::class)
        ->call('approve', $withdrawal->id)
        ->assertHasNoErrors()
        ->assertSee('Penarikan dana berhasil disetujui.');

    $withdrawal = $withdrawal->fresh();
    $transaction = $transaction->fresh();

    expect($withdrawal->status)->toBe(WithdrawalStatus::Completed)
        ->and($withdrawal->processed_by_user_id)->toBe($admin->id)
        ->and($withdrawal->processed_at)->not->toBeNull()
        ->and($transaction->description)->toContain('disetujui admin');
});

it('admin can reject a pending withdrawal and refund the wallet', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();

    $wallet = VendorWallet::query()->create([
        'user_id' => $vendor->id,
        'balance' => 250000,
        'total_earned' => 650000,
        'total_withdrawn' => 150000,
    ]);

    $withdrawal = WalletWithdrawal::query()->create([
        'vendor_wallet_id' => $wallet->id,
        'amount' => 150000,
        'status' => WithdrawalStatus::Pending,
        'bank_details' => [
            'bank_name' => 'Bank Mandiri',
            'bank_account_name' => 'Vendor Test',
            'bank_account_number' => '987654321',
        ],
        'notes' => 'Mohon diproses hari ini.',
    ]);

    $transaction = $wallet->transactions()->create([
        'type' => WalletTransactionType::Withdrawal,
        'amount' => 150000,
        'description' => 'Penarikan dana ke Bank Mandiri - 987654321',
        'withdrawal_id' => $withdrawal->id,
    ]);

    $this->actingAs($admin);

    Livewire::test(WithdrawalManagement::class)
        ->call('confirmReject', $withdrawal->id)
        ->set('rejectReason', 'Nomor rekening tidak valid.')
        ->call('reject')
        ->assertHasNoErrors()
        ->assertSee('Penarikan dana ditolak dan saldo dikembalikan.');

    $withdrawal = $withdrawal->fresh();
    $wallet = $wallet->fresh();
    $transaction = $transaction->fresh();

    expect($withdrawal->status)->toBe(WithdrawalStatus::Rejected)
        ->and($withdrawal->processed_by_user_id)->toBe($admin->id)
        ->and($withdrawal->rejection_reason)->toBe('Nomor rekening tidak valid.')
        ->and((float) $wallet->balance)->toBe(400000.0)
        ->and((float) $wallet->total_withdrawn)->toBe(0.0)
        ->and($transaction->type)->toBe(WalletTransactionType::Withdrawal)
        ->and($transaction->description)->toContain('ditolak admin');
});

it('admin monthly report refreshes report data when the period changes', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'total_amount' => 1250000,
        'created_at' => Carbon::create(2026, 1, 5),
    ]);

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
        'total_amount' => 900000,
        'created_at' => Carbon::create(2026, 2, 7),
    ]);

    $this->actingAs($admin);

    $component = Livewire::test(MonthlyReport::class)
        ->set('selectedYear', 2026)
        ->set('selectedMonth', 1);

    $januaryReport = $component->viewData('report');

    expect($januaryReport['total_transactions'])->toBe(1)
        ->and($januaryReport['total_revenue'])->toBe(1250000.0)
        ->and($januaryReport['daily_trends'][4]['transactions'])->toBe(1);

    $component
        ->set('selectedMonth', 2)
        ->assertDispatched('refreshCharts');

    $februaryReport = $component->viewData('report');

    expect($februaryReport['total_transactions'])->toBe(1)
        ->and($februaryReport['total_revenue'])->toBe(0.0)
        ->and($februaryReport['pending_count'])->toBe(1)
        ->and($februaryReport['daily_trends'][6]['transactions'])->toBe(1)
        ->and($februaryReport['daily_trends'][6]['revenue'])->toBe(0.0);
});

it('admin can export the selected monthly report as pdf', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'total_amount' => 2400000,
        'created_at' => Carbon::create(2026, 3, 10),
    ]);

    $this->actingAs($admin);

    Livewire::test(MonthlyReport::class)
        ->set('selectedMonth', 3)
        ->set('selectedYear', 2026)
        ->call('exportPdf')
        ->assertFileDownloaded('ILT_Laporan_Maret_2026.pdf');
});
