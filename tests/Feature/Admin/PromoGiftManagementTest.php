<?php

use App\Enums\PromoDiscountType;
use App\Enums\PromoStatus;
use App\Livewire\Admin\PromoGiftManagement;
use App\Models\GiftCard;
use App\Models\Promo;
use App\Models\TourCategory;
use App\Models\User;
use Livewire\Livewire;

it('admin can create an internal promo from the admin livewire page', function () {
    $admin = User::factory()->admin()->create();
    $category = TourCategory::factory()->create([
        'name' => 'Luxury Escape',
    ]);

    $this->actingAs($admin);

    Livewire::test(PromoGiftManagement::class)
        ->call('openCreateForm')
        ->set('code', 'LUXE-ADMIN')
        ->set('description', 'Promo internal untuk pelanggan prioritas.')
        ->set('group', 'Indonesia Luxe')
        ->set('discount_type', PromoDiscountType::Percent->value)
        ->set('discount_value', 15)
        ->set('min_purchase', 500000)
        ->set('category_restriction', $category->name)
        ->set('valid_from', now()->toDateString())
        ->set('valid_until', now()->addDays(10)->toDateString())
        ->call('savePromo')
        ->assertHasNoErrors();

    $promo = Promo::query()->firstOrFail();

    expect($promo->vendor_id)->toBe($admin->id)
        ->and($promo->status)->toBe(PromoStatus::Active)
        ->and($promo->category_restriction)->toBe($category->name)
        ->and($promo->isInternal())->toBeTrue();
});

it('admin can create an internal gift card from the admin livewire page', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin);

    Livewire::test(PromoGiftManagement::class)
        ->call('setType', 'gift_card')
        ->call('openCreateForm')
        ->set('gift_code', 'GIFT-LUXE-2026')
        ->set('gift_value', 250000)
        ->set('max_usages', 25)
        ->set('expires_at', now()->addDays(20)->toDateString())
        ->call('saveGiftCard')
        ->assertHasNoErrors();

    $giftCard = GiftCard::query()->firstOrFail();

    expect($giftCard->vendor_id)->toBe($admin->id)
        ->and($giftCard->status)->toBe(PromoStatus::Active)
        ->and($giftCard->value)->toBe('250000.00')
        ->and($giftCard->isInternal())->toBeTrue();
});

it('admin can approve a pending vendor promo from the admin livewire page', function () {
    $admin = User::factory()->admin()->create();
    $promo = Promo::factory()->pendingApproval()->create();

    $this->actingAs($admin);

    Livewire::test(PromoGiftManagement::class)
        ->call('approve', $promo->id)
        ->assertHasNoErrors();

    expect($promo->refresh()->status)->toBe(PromoStatus::Active)
        ->and($promo->is_active)->toBeTrue()
        ->and($promo->rejected_reason)->toBeNull();
});

it('admin can reject a pending vendor gift card with a reason', function () {
    $admin = User::factory()->admin()->create();
    $giftCard = GiftCard::factory()->pendingApproval()->create();

    $this->actingAs($admin);

    Livewire::test(PromoGiftManagement::class)
        ->call('setType', 'gift_card')
        ->call('confirmReject', $giftCard->id)
        ->set('rejectReason', 'Nominal tidak sesuai kebijakan promosi saat ini.')
        ->call('rejectSelected')
        ->assertHasNoErrors();

    expect($giftCard->refresh()->status)->toBe(PromoStatus::Rejected)
        ->and($giftCard->is_active)->toBeFalse()
        ->and($giftCard->rejected_reason)->toBe('Nominal tidak sesuai kebijakan promosi saat ini.');
});
