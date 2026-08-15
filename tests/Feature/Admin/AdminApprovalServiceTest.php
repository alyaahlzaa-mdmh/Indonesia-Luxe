<?php

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Enums\PaymentValidationStatus;
use App\Enums\VendorStatus;
use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSubmission;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use App\Services\AdminApprovalService;

beforeEach(function () {
    $this->adminApprovalService = app(AdminApprovalService::class);
    $this->admin = User::factory()->admin()->create();
});

// ─── Vendor Approval ────────────────────────────────────────────

it('approves vendor profile correctly', function () {
    $vendor = User::factory()->vendor()->create();
    $profile = VendorProfile::factory()->create(['user_id' => $vendor->id]);

    $result = $this->adminApprovalService->approveVendor($profile, $this->admin);

    expect($result->status)->toBe(VendorStatus::Approved)
        ->and($result->approved_at)->not->toBeNull()
        ->and($result->approved_by_user_id)->toBe($this->admin->id)
        ->and($result->rejected_reason)->toBeNull();
});

it('rejects vendor profile with reason', function () {
    $vendor = User::factory()->vendor()->create();
    $profile = VendorProfile::factory()->create(['user_id' => $vendor->id]);

    $result = $this->adminApprovalService->rejectVendor($profile, $this->admin, 'Dokumen tidak valid');

    expect($result->status)->toBe(VendorStatus::Rejected)
        ->and($result->approved_at)->toBeNull()
        ->and($result->approved_by_user_id)->toBe($this->admin->id)
        ->and($result->rejected_reason)->toBe('Dokumen tidak valid');
});

// ─── Package Approval ───────────────────────────────────────────

it('approves package changes status to published', function () {
    $package = TourPackage::factory()->pendingApproval()->create();

    $result = $this->adminApprovalService->approvePackage($package, $this->admin);

    expect($result->status)->toBe(PackageStatus::Published)
        ->and($result->approved_at)->not->toBeNull()
        ->and($result->approved_by_user_id)->toBe($this->admin->id)
        ->and($result->rejected_reason)->toBeNull();
});

it('rejects package with reason', function () {
    $package = TourPackage::factory()->pendingApproval()->create();

    $result = $this->adminApprovalService->rejectPackage($package, $this->admin, 'Deskripsi kurang');

    expect($result->status)->toBe(PackageStatus::Rejected)
        ->and($result->approved_at)->toBeNull()
        ->and($result->rejected_reason)->toBe('Deskripsi kurang');
});

// ─── Payment Approval ───────────────────────────────────────────

it('approving payment updates order and bookings', function () {
    $customer = User::factory()->customer()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $package = TourPackage::factory()->create(['vendor_id' => $vendor->id]);

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

    $submission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
    ]);

    $result = $this->adminApprovalService->approvePayment($submission, $this->admin);

    expect($result->status)->toBe(PaymentValidationStatus::Approved)
        ->and($result->validated_by_user_id)->toBe($this->admin->id)
        ->and($result->validated_at)->not->toBeNull()
        ->and($order->refresh()->status)->toBe(OrderStatus::Paid)
        ->and($order->paid_at)->not->toBeNull()
        ->and($booking->refresh()->status)->toBe(BookingStatus::Confirmed)
        ->and($booking->confirmed_at)->not->toBeNull()
        ->and($orderItem->refresh()->status)->toBe(BookingStatus::Confirmed);
});

it('rejecting payment resets order to pending payment', function () {
    $customer = User::factory()->customer()->create();

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
    ]);

    $submission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
    ]);

    $result = $this->adminApprovalService->rejectPayment($submission, $this->admin, 'Bukti tidak valid');

    expect($result->status)->toBe(PaymentValidationStatus::Rejected)
        ->and($result->rejection_reason)->toBe('Bukti tidak valid')
        ->and($result->validated_by_user_id)->toBe($this->admin->id)
        ->and($order->refresh()->status)->toBe(OrderStatus::PendingPayment);
});

it('approving a non-pending payment leaves the existing state unchanged', function () {
    $customer = User::factory()->customer()->create();

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::PendingPayment,
        'paid_at' => null,
    ]);

    $submission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Rejected,
        'rejection_reason' => 'Sudah pernah ditolak',
        'validated_by_user_id' => $this->admin->id,
        'validated_at' => now()->subMinute(),
    ]);

    $originalValidatedAt = $submission->validated_at;

    $result = $this->adminApprovalService->approvePayment($submission, $this->admin);

    expect($result->status)->toBe(PaymentValidationStatus::Rejected)
        ->and($result->rejection_reason)->toBe('Sudah pernah ditolak')
        ->and($result->validated_at?->equalTo($originalValidatedAt))->toBeTrue()
        ->and($order->refresh()->status)->toBe(OrderStatus::PendingPayment)
        ->and($order->paid_at)->toBeNull();
});

it('rejecting a non-pending payment leaves the existing state unchanged', function () {
    $customer = User::factory()->customer()->create();

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'paid_at' => now(),
    ]);

    $submission = PaymentSubmission::factory()->create([
        'order_id' => $order->id,
        'submitted_by_user_id' => $customer->id,
        'status' => PaymentValidationStatus::Approved,
        'validated_by_user_id' => $this->admin->id,
        'validated_at' => now()->subMinute(),
        'rejection_reason' => null,
    ]);

    $originalValidatedAt = $submission->validated_at;

    $result = $this->adminApprovalService->rejectPayment($submission, $this->admin, 'Tidak boleh berubah lagi');

    expect($result->status)->toBe(PaymentValidationStatus::Approved)
        ->and($result->rejection_reason)->toBeNull()
        ->and($result->validated_at?->equalTo($originalValidatedAt))->toBeTrue()
        ->and($order->refresh()->status)->toBe(OrderStatus::Paid)
        ->and($order->paid_at)->not->toBeNull();
});
