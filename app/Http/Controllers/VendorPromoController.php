<?php

namespace App\Http\Controllers;

use App\Enums\PromoStatus;
use App\Http\Requests\StoreGiftCardRequest;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdateGiftCardRequest;
use App\Http\Requests\UpdatePromoRequest;
use App\Models\GiftCard;
use App\Models\Promo;
use App\Models\TourCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VendorPromoController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $promos = $user->promos()->latest()->get();
        $pendingPromos = $user->promos()->where('status', PromoStatus::PendingApproval)->count();
        $activePromos = $user->promos()->where('status', PromoStatus::Active)->count();
        $rejectedPromos = $user->promos()->where('status', PromoStatus::Rejected)->count();
        $giftCards = $user->giftCards()->latest()->get();
        $pendingGiftCards = $user->giftCards()->where('status', PromoStatus::PendingApproval)->count();
        $activeGiftCards = $user->giftCards()->where('status', PromoStatus::Active)->count();
        $rejectedGiftCards = $user->giftCards()->where('status', PromoStatus::Rejected)->count();
        $categories = TourCategory::all();

        return view('vendor.promo.index', compact('promos', 'pendingPromos', 'activePromos', 'rejectedPromos', 'giftCards', 'pendingGiftCards', 'activeGiftCards', 'rejectedGiftCards', 'categories'));
    }

    public function storePromo(StorePromoRequest $request): RedirectResponse
    {
        auth()->user()->promos()->create([
            ...$request->validated(),
            'status' => PromoStatus::PendingApproval,
        ]);

        return redirect()->route('vendor.promo.index')
            ->with('status', 'Kode promo berhasil diajukan dan sedang menunggu persetujuan admin.');
    }

    public function updatePromo(UpdatePromoRequest $request, Promo $promo): RedirectResponse
    {
        if ($promo->vendor_id !== auth()->id()) {
            abort(403);
        }

        $promo->update([
            ...$request->validated(),
            'status' => PromoStatus::PendingApproval,
        ]);

        return redirect()->route('vendor.promo.index')
            ->with('status', 'Kode promo berhasil diperbarui dan dikirim kembali untuk persetujuan admin.');
    }

    public function destroyPromo(Promo $promo): RedirectResponse
    {
        if ($promo->vendor_id !== auth()->id()) {
            abort(403);
        }

        $promo->delete();

        return redirect()->route('vendor.promo.index')
            ->with('status', 'Kode promo berhasil dihapus.');
    }

    public function storeGiftCard(StoreGiftCardRequest $request): RedirectResponse
    {
        auth()->user()->giftCards()->create([
            ...$request->validated(),
            'status' => PromoStatus::PendingApproval,
        ]);

        return redirect()->route('vendor.promo.index')
            ->with('status', 'Gift card berhasil diajukan dan sedang menunggu persetujuan admin.');
    }

    public function updateGiftCard(UpdateGiftCardRequest $request, GiftCard $giftCard): RedirectResponse
    {
        if ($giftCard->vendor_id !== auth()->id()) {
            abort(403);
        }

        $giftCard->update([
            ...$request->validated(),
            'status' => PromoStatus::PendingApproval,
        ]);

        return redirect()->route('vendor.promo.index')
            ->with('status', 'Gift card berhasil diperbarui dan dikirim kembali untuk persetujuan admin.');
    }

    public function destroyGiftCard(GiftCard $giftCard): RedirectResponse
    {
        if ($giftCard->vendor_id !== auth()->id()) {
            abort(403);
        }

        $giftCard->delete();

        return redirect()->route('vendor.promo.index')
            ->with('status', 'Gift card berhasil dihapus.');
    }
}
