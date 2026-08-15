<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\VendorProfile;
use App\Services\ReportService;
use Illuminate\Support\Carbon;

beforeEach(function () {
    $this->reportService = app(ReportService::class);
});

// ─── Vendor Sales Report ────────────────────────────────────────

it('calculates vendor sales correctly', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $customer = User::factory()->customer()->create();

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'created_at' => now(),
    ]);

    OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'quantity' => 2,
        'price_per_person' => 500000,
        'line_total' => 1000000,
    ]);

    OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'quantity' => 1,
        'price_per_person' => 300000,
        'line_total' => 300000,
    ]);

    $report = $this->reportService->vendorSales($vendor);

    expect($report['total_revenue'])->toBe(1300000.0)
        ->and($report['total_items'])->toBe(3)
        ->and($report['total_orders'])->toBe(1);
});

it('vendor sales excludes cancelled orders', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $customer = User::factory()->customer()->create();

    $cancelledOrder = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Cancelled,
        'created_at' => now(),
    ]);

    OrderItem::factory()->create([
        'order_id' => $cancelledOrder->id,
        'vendor_id' => $vendor->id,
        'quantity' => 5,
        'line_total' => 2500000,
    ]);

    $report = $this->reportService->vendorSales($vendor);

    expect($report['total_revenue'])->toBe(0.0)
        ->and($report['total_items'])->toBe(0)
        ->and($report['total_orders'])->toBe(0);
});

it('vendor sales filters by date range', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);
    $customer = User::factory()->customer()->create();

    // Order in January
    $janOrder = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'created_at' => Carbon::create(2026, 1, 15),
    ]);

    OrderItem::factory()->create([
        'order_id' => $janOrder->id,
        'vendor_id' => $vendor->id,
        'line_total' => 500000,
        'quantity' => 1,
    ]);

    // Order in February
    $febOrder = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'created_at' => Carbon::create(2026, 2, 15),
    ]);

    OrderItem::factory()->create([
        'order_id' => $febOrder->id,
        'vendor_id' => $vendor->id,
        'line_total' => 800000,
        'quantity' => 2,
    ]);

    $janReport = $this->reportService->vendorSales(
        $vendor,
        Carbon::create(2026, 1, 1),
        Carbon::create(2026, 1, 31, 23, 59, 59)
    );

    expect($janReport['total_revenue'])->toBe(500000.0)
        ->and($janReport['total_items'])->toBe(1);
});

// ─── Admin Monthly Report ───────────────────────────────────────

it('calculates admin monthly report correctly', function () {
    $customer = User::factory()->customer()->create();

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'total_amount' => 1500000,
        'created_at' => Carbon::create(2026, 3, 2),
    ]);

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::PartiallyConfirmed,
        'total_amount' => 2000000,
        'created_at' => Carbon::create(2026, 3, 4),
    ]);

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::PendingPayment,
        'total_amount' => 500000,
        'created_at' => Carbon::create(2026, 3, 6),
    ]);

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::AwaitingValidation,
        'total_amount' => 750000,
        'created_at' => Carbon::create(2026, 3, 8),
    ]);

    $report = $this->reportService->adminMonthly(Carbon::create(2026, 3, 1));

    expect($report['month'])->toBe('Maret 2026')
        ->and($report['total_transactions'])->toBe(4)
        ->and($report['total_revenue'])->toBe(3500000.0)
        ->and($report['confirmed_count'])->toBe(2)
        ->and($report['pending_count'])->toBe(2)
        ->and($report['status_distribution']['approved']['count'])->toBe(2)
        ->and($report['status_distribution']['pending']['count'])->toBe(2)
        ->and($report['daily_trends'][1]['revenue'])->toBe(1500000.0)
        ->and($report['daily_trends'][5]['transactions'])->toBe(1)
        ->and($report['orders'])->toHaveCount(4);
});
