<?php

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourCategory;
use App\Models\TourDepartureSlot;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;

it('vendor sales report is accessible and shows totals', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $customer = User::factory()->customer()->create();
    $category = TourCategory::factory()->create();
    $package = TourPackage::factory()->create([
        'vendor_id' => $vendor->id,
        'tour_category_id' => $category->id,
    ]);
    $slot = TourDepartureSlot::factory()->create(['tour_package_id' => $package->id]);

    $order = Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'total_amount' => 1200000,
    ]);

    OrderItem::factory()->create([
        'order_id' => $order->id,
        'vendor_id' => $vendor->id,
        'tour_package_id' => $package->id,
        'tour_departure_slot_id' => $slot->id,
        'line_total' => 1200000,
        'quantity' => 2,
    ]);

    $this->actingAs($vendor)
        ->get(route('vendor.reports.sales'))
        ->assertOk()
        ->assertSee('1.200.000');
});

it('admin monthly report is accessible and shows totals', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->customer()->create();

    Order::factory()->create([
        'user_id' => $customer->id,
        'status' => OrderStatus::Paid,
        'total_amount' => 2500000,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.reports.monthly'))
        ->assertOk()
        ->assertSee('2.500.000');
});
