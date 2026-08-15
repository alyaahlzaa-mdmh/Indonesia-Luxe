<?php

namespace App\Livewire\Admin;

use App\Enums\PromoDiscountType;
use App\Enums\PromoStatus;
use App\Livewire\Admin\Concerns\WithAdminFilters;
use App\Livewire\Admin\Concerns\WithAdminPagination;
use App\Livewire\Admin\Concerns\WithPromoQueries;
use App\Models\GiftCard;
use App\Models\Promo;
use App\Models\TourCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class PromoGiftManagement extends Component
{
    use WithAdminFilters, WithAdminPagination, WithPromoQueries;

    public bool $isCreating = false;

    public ?int $selectedItemId = null;

    public bool $showRejectForm = false;

    public string $rejectReason = '';

    public string $activeType = 'promo';

    public string $code = '';

    public string $description = '';

    public string $group = 'Indonesia Luxe';

    public string $discount_type = 'percent';

    public mixed $discount_value = null;

    public mixed $min_purchase = 0;

    public string $category_restriction = '';

    public ?string $valid_from = null;

    public ?string $valid_until = null;

    public string $gift_code = '';

    public mixed $gift_value = null;

    public int $max_usages = 100;

    public ?string $expires_at = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'activeType' => ['except' => 'promo'],
        'statusFilter' => ['except' => 'pending_approval'],
    ];

    public function mount(): void
    {
        if (! request()->has('statusFilter')) {
            $this->statusFilter = PromoStatus::PendingApproval->value;
        }

        $this->resetCreateForm();
    }

    protected function rules(): array
    {
        if ($this->activeType === 'promo') {
            $discountValueRules = ['required', 'numeric', 'min:0'];

            if ($this->discount_type === PromoDiscountType::Percent->value) {
                $discountValueRules[] = 'max:100';
            }

            return [
                'code' => ['required', 'string', 'max:50', Rule::unique('promos', 'code')],
                'description' => ['required', 'string', 'max:255'],
                'group' => ['nullable', 'string', 'max:100'],
                'discount_type' => ['required', Rule::in([
                    PromoDiscountType::Percent->value,
                    PromoDiscountType::Flat->value,
                ])],
                'discount_value' => $discountValueRules,
                'min_purchase' => ['nullable', 'numeric', 'min:0'],
                'category_restriction' => ['nullable', 'string', 'max:100', Rule::exists('tour_categories', 'name')],
                'valid_from' => ['nullable', 'date'],
                'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            ];
        }

        return [
            'gift_code' => ['required', 'string', 'max:50', Rule::unique('gift_cards', 'code')],
            'gift_value' => ['required', 'numeric', 'min:1000'],
            'max_usages' => ['required', 'integer', 'min:1'],
            'expires_at' => ['required', 'date', 'after:today'],
        ];
    }

    public function setType(string $type): void
    {
        if (! in_array($type, ['promo', 'gift_card'], true)) {
            return;
        }

        $this->activeType = $type;
        $this->closeCreateForm();
        $this->clearSelection();
        $this->resetPage();
    }

    public function setStatus(string $status): void
    {
        $this->statusFilter = $status;
        $this->clearSelection();
        $this->resetPage();
    }

    public function openCreateForm(): void
    {
        $this->clearSelection();
        $this->resetCreateForm();
        $this->isCreating = true;
        $this->generateCode();
    }

    public function closeCreateForm(): void
    {
        $this->isCreating = false;
        $this->resetCreateForm();
    }

    public function generateCode(): void
    {
        do {
            $generatedCode = $this->activeType === 'promo'
                ? strtoupper(Str::random(8))
                : 'GIFT-'.strtoupper(Str::random(8));
        } while ($this->currentPromoModel()::query()->where('code', $generatedCode)->exists());

        if ($this->activeType === 'promo') {
            $this->code = $generatedCode;

            return;
        }

        $this->gift_code = $generatedCode;
    }

    public function savePromo(): void
    {
        $validated = $this->validate();

        Promo::query()->create([
            'vendor_id' => auth()->id(),
            'code' => $validated['code'],
            'description' => $validated['description'],
            'group' => $validated['group'] ?: 'Indonesia Luxe',
            'discount_type' => $validated['discount_type'],
            'discount_value' => $validated['discount_value'],
            'min_purchase' => $validated['min_purchase'] ?? 0,
            'category_restriction' => $validated['category_restriction'] ?: null,
            'valid_from' => $validated['valid_from'] ?? null,
            'valid_until' => $validated['valid_until'] ?? null,
            'is_active' => true,
            'status' => PromoStatus::Active,
            'rejected_reason' => null,
        ]);

        $this->closeCreateForm();
        session()->flash('status', 'Promo Indonesia Luxe berhasil dibuat dan langsung aktif.');
    }

    public function saveGiftCard(): void
    {
        $validated = $this->validate();

        GiftCard::query()->create([
            'vendor_id' => auth()->id(),
            'code' => $validated['gift_code'],
            'value' => $validated['gift_value'],
            'expires_at' => $validated['expires_at'],
            'max_usages' => $validated['max_usages'],
            'used_count' => 0,
            'is_active' => true,
            'status' => PromoStatus::Active,
            'rejected_reason' => null,
        ]);

        $this->closeCreateForm();
        session()->flash('status', 'Gift Card Indonesia Luxe berhasil dibuat dan langsung aktif.');
    }

    public function toggleSelection(int $itemId): void
    {
        if ($this->selectedItemId === $itemId) {
            $this->clearSelection();

            return;
        }

        $this->selectedItemId = $itemId;
        $this->showRejectForm = false;
        $this->rejectReason = '';
    }

    public function approve(int $itemId): void
    {
        $item = $this->findCurrentItemOrFail($itemId);

        $item->update([
            'status' => PromoStatus::Active,
            'is_active' => true,
            'rejected_reason' => null,
        ]);

        session()->flash(
            'status',
            $this->activeType === 'promo'
                ? 'Promo berhasil disetujui.'
                : 'Gift card berhasil disetujui.'
        );
    }

    public function confirmReject(int $itemId): void
    {
        $this->selectedItemId = $itemId;
        $this->showRejectForm = true;
        $this->rejectReason = '';
    }

    public function cancelReject(): void
    {
        $this->showRejectForm = false;
        $this->rejectReason = '';
    }

    public function rejectSelected(): void
    {
        if ($this->selectedItemId === null) {
            return;
        }

        $this->validate([
            'rejectReason' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $item = $this->findCurrentItemOrFail($this->selectedItemId);

        $item->update([
            'status' => PromoStatus::Rejected,
            'is_active' => false,
            'rejected_reason' => $this->rejectReason,
        ]);

        $this->showRejectForm = false;
        $this->rejectReason = '';

        session()->flash(
            'status',
            $this->activeType === 'promo'
                ? 'Promo berhasil ditolak.'
                : 'Gift card berhasil ditolak.'
        );
    }

    public function refresh(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.admin.promo-gift-management', array_merge(
            [
                'items' => $this->buildQuery()->paginate($this->perPage),
                'categories' => TourCategory::query()->orderBy('name')->get(),
            ],
            $this->getStats()
        ))->layout('components.layouts.admin');
    }

    protected function findCurrentItemOrFail(int $itemId): Model
    {
        return $this->currentPromoModel()::query()->with('vendor')->findOrFail($itemId);
    }

    protected function clearSelection(): void
    {
        $this->selectedItemId = null;
        $this->showRejectForm = false;
        $this->rejectReason = '';
    }

    protected function resetCreateForm(): void
    {
        $this->resetValidation();
        $this->code = '';
        $this->description = '';
        $this->group = 'Indonesia Luxe';
        $this->discount_type = PromoDiscountType::Percent->value;
        $this->discount_value = null;
        $this->min_purchase = 0;
        $this->category_restriction = '';
        $this->valid_from = null;
        $this->valid_until = null;
        $this->gift_code = '';
        $this->gift_value = null;
        $this->max_usages = 100;
        $this->expires_at = null;
    }
}
