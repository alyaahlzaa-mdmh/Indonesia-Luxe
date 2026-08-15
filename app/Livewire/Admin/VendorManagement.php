<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Concerns\WithAdminFilters;
use App\Livewire\Admin\Concerns\WithAdminPagination;
use App\Livewire\Admin\Concerns\WithVendorQueries;
use App\Models\VendorProfile;
use App\Services\AdminApprovalService;
use Illuminate\View\View;
use Livewire\Component;

class VendorManagement extends Component
{
    use WithAdminFilters, WithAdminPagination, WithVendorQueries;

    public string $activeTab = 'all';

    public $confirmingRevoke = null;

    public $confirmingApprove = null;

    public $confirmingReject = null;

    public $confirmingDelete = null;

    public string $rejectReason = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'activeTab' => ['except' => 'all'],
    ];

    public function mount(): void
    {
        if ($this->activeTab !== 'all' && ! $this->statusFilter) {
            $this->setTab($this->activeTab);
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->statusFilter = match ($tab) {
            'pending' => 'pending',
            'approved' => 'approved',
            'rejected' => 'rejected',
            default => '',
        };
        $this->resetPage();
    }

    public function confirmApprove(int $vendorId): void
    {
        $this->confirmingApprove = $vendorId;
    }

    public function approve(): void
    {
        if (! $this->confirmingApprove) {
            return;
        }

        $vendor = VendorProfile::findOrFail($this->confirmingApprove);

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->approveVendor($vendor, auth()->user());

        $this->confirmingApprove = null;
        session()->flash('status', 'Vendor berhasil disetujui.');
    }

    public function confirmReject(int $vendorId): void
    {
        $this->confirmingReject = $vendorId;
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

        $vendor = VendorProfile::findOrFail($this->confirmingReject);

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->rejectVendor($vendor, auth()->user(), $this->rejectReason);

        $this->confirmingReject = null;
        $this->rejectReason = '';
        session()->flash('status', 'Vendor berhasil ditolak.');
    }

    public function confirmRevoke(int $vendorId): void
    {
        $this->confirmingRevoke = $vendorId;
    }

    public function revoke(): void
    {
        if (! $this->confirmingRevoke) {
            return;
        }

        $vendor = VendorProfile::findOrFail($this->confirmingRevoke);

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->rejectVendor($vendor, auth()->user(), 'Akses dicabut oleh admin');

        $this->confirmingRevoke = null;
        session()->flash('status', 'Akses vendor berhasil dicabut.');
    }

    public function confirmDelete(int $vendorId): void
    {
        $this->confirmingDelete = $vendorId;
    }

    public function delete(): void
    {
        if (! $this->confirmingDelete) {
            return;
        }

        $vendor = VendorProfile::findOrFail($this->confirmingDelete);
        $vendor->delete();

        $this->confirmingDelete = null;
        session()->flash('status', 'Akun vendor berhasil dihapus.');
    }

    public function render(): View
    {
        return view('livewire.admin.vendor-management', array_merge(
            [
                'vendors' => $this->buildVendorQuery()->paginate($this->perPage),
            ],
            $this->getVendorStats()
        ));
    }
}
