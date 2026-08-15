<?php

use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Models\Order;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Support\Carbon;

// ─── Admin Dashboard Access ─────────────────────────────────────

it('admin can access admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk();
});

it('admin dashboard includes logout confirmation modal', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('data-test="admin-logout-trigger"', false)
        ->assertSee('Keluar dari akun?')
        ->assertSee('Kamu akan keluar dari sesi ini.')
        ->assertSee('Ya, Keluar');
});

it('admin dashboard renders trend chart data for the last six months', function () {
    Carbon::setTestNow('2026-03-11 12:00:00');

    try {
        $admin = User::factory()->admin()->create();
        $customer = User::factory()->customer()->create();

        Order::factory()->create([
            'user_id' => $customer->id,
            'status' => OrderStatus::Paid,
            'total_amount' => 1250000,
            'created_at' => Carbon::parse('2026-02-14 09:00:00'),
            'updated_at' => Carbon::parse('2026-02-14 09:00:00'),
        ]);

        Order::factory()->create([
            'user_id' => $customer->id,
            'status' => OrderStatus::Completed,
            'total_amount' => 2300000,
            'created_at' => Carbon::parse('2026-03-03 14:00:00'),
            'updated_at' => Carbon::parse('2026-03-03 14:00:00'),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('adminTrendChart')
            ->assertSee('admin-trend-chart')
            ->assertSee('Okt')
            ->assertSee('Mar')
            ->assertSee('1250000')
            ->assertSee('2300000')
            ->assertSee('maxTransactions');
    } finally {
        Carbon::setTestNow();
    }
});

it('customer cannot access admin dashboard', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('vendor cannot access admin dashboard', function () {
    $vendor = User::factory()->vendor()->create();

    $this->actingAs($vendor)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('guest cannot access admin dashboard', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('login'));
});

// ─── Admin Vendors Page ─────────────────────────────────────────

it('admin can view vendors list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.vendors.index'))
        ->assertOk();
});

it('customer cannot access vendors list', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('admin.vendors.index'))
        ->assertForbidden();
});

// ─── Admin Packages Page ────────────────────────────────────────

it('admin can view packages list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.packages.index'))
        ->assertOk();
});

it('admin can approve a pending package', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $package = TourPackage::factory()->pendingApproval()->create([
        'vendor_id' => $vendor->id,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.packages.update', $package), [
            'action' => 'approve',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($package->refresh()->status)->toBe(PackageStatus::Published)
        ->and($package->approved_by_user_id)->toBe($admin->id);
});

it('admin can reject a pending package', function () {
    $admin = User::factory()->admin()->create();
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $package = TourPackage::factory()->pendingApproval()->create([
        'vendor_id' => $vendor->id,
    ]);

    $this->actingAs($admin)
        ->patch(route('admin.packages.update', $package), [
            'action' => 'reject',
            'reason' => 'Deskripsi kurang lengkap.',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    expect($package->refresh()->status)->toBe(PackageStatus::Rejected)
        ->and($package->rejected_reason)->toBe('Deskripsi kurang lengkap.');
});

// ─── Admin Payments Page ────────────────────────────────────────

it('admin can view payments list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.payments.index'))
        ->assertOk();
});

// ─── Admin Transactions Page ────────────────────────────────────

it('admin can view transactions list', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.transactions.index'))
        ->assertOk();
});

// ─── Admin Reports Page ─────────────────────────────────────────

it('admin can view monthly reports', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('admin.reports.monthly'))
        ->assertOk();
});

it('customer cannot access admin reports', function () {
    $customer = User::factory()->customer()->create();

    $this->actingAs($customer)
        ->get(route('admin.reports.monthly'))
        ->assertForbidden();
});
