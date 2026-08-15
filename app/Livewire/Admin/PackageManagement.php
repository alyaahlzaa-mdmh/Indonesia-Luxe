<?php

namespace App\Livewire\Admin;

use App\Enums\PackageStatus;
use App\Livewire\Admin\Concerns\WithAdminFilters;
use App\Livewire\Admin\Concerns\WithAdminPagination;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Services\AdminApprovalService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class PackageManagement extends Component
{
    use WithAdminFilters, WithAdminPagination;

    public bool $isCreating = false;

    // Form fields
    public $title;

    public $type = 'open_trip';

    public $tour_category_id;

    public $meeting_point;

    public $price;

    public $duration_days = 1;

    public $max_participants = 10;

    public $image_url;

    public $description;

    public $highlights;

    public $included;

    public string $activeTab = 'semua';

    public $confirmingApprove = null;

    public $confirmingReject = null;

    public $confirmingDelete = null;

    public $selectedPackage = null;

    public string $rejectReason = '';

    protected $rules = [
        'title' => 'required|string|min:3',
        'type' => 'required',
        'tour_category_id' => 'required|exists:tour_categories,id',
        'meeting_point' => 'required|string',
        'price' => 'required|numeric|min:0',
        'duration_days' => 'required|integer|min:1',
        'max_participants' => 'required|integer|min:1',
        'image_url' => 'nullable|url',
        'description' => 'required|string',
        'highlights' => 'nullable|string',
        'included' => 'nullable|string',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'activeTab' => ['except' => 'semua'],
    ];

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function getStats(): array
    {
        return [
            'totalCount' => TourPackage::count(),
            'internalCount' => TourPackage::internal()->count(),
            'pendingCount' => TourPackage::pendingApproval()->count(),
            'approvedCount' => TourPackage::query()->where('status', PackageStatus::Published)->count(),
            'rejectedCount' => TourPackage::query()->where('status', PackageStatus::Rejected)->count(),
        ];
    }

    public function buildQuery(): Builder
    {
        $query = TourPackage::query()->with(['vendor', 'category']);

        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%');
        }

        match ($this->activeTab) {
            'pending' => $query->where('status', PackageStatus::PendingApproval),
            'approved' => $query->where('status', PackageStatus::Published),
            'rejected' => $query->where('status', PackageStatus::Rejected),
            default => null,
        };

        return $query->latest();
    }

    public function confirmApprove(int $packageId): void
    {
        $this->confirmingApprove = $packageId;
    }

    public function approve(): void
    {
        if (! $this->confirmingApprove) {
            return;
        }

        $package = TourPackage::findOrFail($this->confirmingApprove);

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->approvePackage($package, auth()->user());

        $this->confirmingApprove = null;
        session()->flash('status', 'Paket tour berhasil disetujui.');
    }

    public function confirmReject(int $packageId): void
    {
        $this->confirmingReject = $packageId;
        $this->rejectReason = '';
    }

    public function reject(): void
    {
        if (! $this->confirmingReject) {
            return;
        }

        $this->validate([
            'rejectReason' => 'required|string|min:5',
        ]);

        $package = TourPackage::findOrFail($this->confirmingReject);

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->rejectPackage($package, auth()->user(), $this->rejectReason);

        $this->confirmingReject = null;
        $this->rejectReason = '';
        if ($this->selectedPackage && $this->selectedPackage->id == $package->id) {
            $this->selectedPackage = $package->fresh();
        }
        session()->flash('status', 'Paket tour telah ditolak.');
    }

    public function selectPackage(int $packageId): void
    {
        $this->selectedPackage = TourPackage::with(['vendor', 'category'])->findOrFail($packageId);
    }

    public function closeDetail(): void
    {
        $this->selectedPackage = null;
    }

    public function togglePublish(int $packageId): void
    {
        $package = TourPackage::findOrFail($packageId);

        if ($package->status === PackageStatus::Published) {
            $package->status = PackageStatus::Draft;
            $package->is_active = false;
            $msg = 'Paket tour berhasil di-unpublish.';
        } else {
            $package->status = PackageStatus::Published;
            $package->is_active = true;
            $package->approved_at = now();
            $package->approved_by_user_id = auth()->id();
            $msg = 'Paket tour berhasil di-publish.';
        }

        $package->save();
        $this->selectedPackage = $package->fresh(['vendor', 'category']);
        session()->flash('status', $msg);
    }

    public function confirmDeleteDetail(int $packageId): void
    {
        $this->confirmingDelete = $packageId;
    }

    public function deletePackage(): void
    {
        if (! $this->confirmingDelete) {
            return;
        }

        $package = TourPackage::findOrFail($this->confirmingDelete);
        $package->delete();

        $this->confirmingDelete = null;
        $this->selectedPackage = null;
        session()->flash('status', 'Paket tour berhasil dihapus.');
    }

    public function openCreateForm(): void
    {
        $this->resetCreateForm();
        $this->isCreating = true;
        $this->tour_category_id = TourCategory::query()->orderBy('name')->value('id');
    }

    public function closeCreateForm(): void
    {
        $this->isCreating = false;
        $this->resetCreateForm();
    }

    public function savePackage(): void
    {
        $this->validate();

        $package = TourPackage::create([
            'vendor_id' => auth()->id(),
            'tour_category_id' => $this->tour_category_id,
            'status' => PackageStatus::Published,
            'type' => $this->type,
            'title' => $this->title,
            'slug' => TourPackage::generateUniqueSlug($this->title),
            'description' => $this->description,
            'highlights' => $this->parseList($this->highlights),
            'included' => $this->parseList($this->included),
            'meeting_point' => $this->meeting_point,
            'duration_hours' => $this->duration_days * 24,
            'max_participants' => $this->max_participants,
            'price_per_person' => $this->price,
            'cover_image_path' => $this->image_url,
            'is_active' => true,
            'approved_at' => now(),
            'approved_by_user_id' => auth()->id(),
        ]);

        $this->closeCreateForm();
        $this->selectedPackage = $package->fresh(['vendor', 'category']);
        session()->flash('status', 'Paket tour internal berhasil dibuat.');
    }

    protected function resetCreateForm(): void
    {
        $this->resetValidation();
        $this->reset([
            'title',
            'tour_category_id',
            'meeting_point',
            'price',
            'image_url',
            'description',
            'highlights',
            'included',
        ]);

        $this->type = 'open_trip';
        $this->duration_days = 1;
        $this->max_participants = 10;
    }

    protected function parseList(?string $value): array
    {
        if (! $value) {
            return [];
        }

        return collect(explode(',', $value))
            ->map(fn (string $item): string => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    public function render(): View
    {
        return view('livewire.admin.package-management', array_merge(
            [
                'packages' => $this->buildQuery()->paginate(12),
                'categories' => TourCategory::query()->orderBy('name')->get(),
            ],
            $this->getStats()
        ))->layout('components.layouts.admin');
    }
}
