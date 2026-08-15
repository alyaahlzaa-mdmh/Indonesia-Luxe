<?php

use App\Enums\PromoStatus;
use App\Models\GiftCard;
use App\Models\User;
use App\Models\VendorProfile;

it('vendor can update gift card without changing code', function () {
    $vendor = User::factory()->vendor()->create();
    VendorProfile::factory()->approved()->create(['user_id' => $vendor->id]);

    $giftCard = GiftCard::query()->create([
        'vendor_id' => $vendor->id,
        'code' => 'GIFT-FIXED-CODE',
        'value' => 150000,
        'expires_at' => now()->addDays(30)->toDateString(),
        'max_usages' => 5,
        'used_count' => 0,
        'is_active' => true,
        'status' => PromoStatus::PendingApproval,
    ]);

    $this->actingAs($vendor)
        ->put(route('vendor.gift-card.update', $giftCard), [
            'code' => 'GIFT-FIXED-CODE',
            'value' => 175000,
            'expires_at' => now()->addDays(45)->toDateString(),
            'max_usages' => 10,
            'is_active' => 1,
        ])
        ->assertRedirect(route('vendor.promo.index'))
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('gift_cards', [
        'id' => $giftCard->id,
        'code' => 'GIFT-FIXED-CODE',
        'max_usages' => 10,
    ]);
});
