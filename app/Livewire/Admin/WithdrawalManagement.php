<?php

namespace App\Livewire\Admin;

use App\Enums\WithdrawalStatus;
use App\Livewire\Admin\Concerns\WithAdminFilters;
use App\Livewire\Admin\Concerns\WithAdminPagination;
use App\Models\WalletWithdrawal;
use App\Services\AdminApprovalService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class WithdrawalManagement extends Component
{
    use WithAdminFilters, WithAdminPagination;

    public ?int $expandedWithdrawalId = null;

    public ?int $confirmingReject = null;

    public string $rejectReason = '';

    public int|string $selectedMonth;

    public int|string $selectedYear;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedMonth' => ['except' => ''],
        'selectedYear' => ['except' => ''],
    ];

    public function mount(): void
    {
        $this->selectedMonth = request('selectedMonth', now()->month);
        $this->selectedYear = request('selectedYear', now()->year);
    }

    public function toggleExpand(int $withdrawalId): void
    {
        if ($this->expandedWithdrawalId === $withdrawalId) {
            $this->expandedWithdrawalId = null;
        } else {
            $this->expandedWithdrawalId = $withdrawalId;
        }
    }

    public function updatingSelectedMonth(): void
    {
        $this->resetPage();
    }

    public function updatingSelectedYear(): void
    {
        $this->resetPage();
    }

    public function approve(int $withdrawalId): void
    {
        $withdrawal = WalletWithdrawal::query()->findOrFail($withdrawalId);

        app(AdminApprovalService::class)->approveWithdrawal($withdrawal, auth()->user());

        session()->flash('status', 'Penarikan dana berhasil disetujui.');
    }

    public function confirmReject(int $withdrawalId): void
    {
        $this->confirmingReject = $withdrawalId;
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

        $withdrawal = WalletWithdrawal::query()->findOrFail($this->confirmingReject);

        app(AdminApprovalService::class)->rejectWithdrawal(
            $withdrawal,
            auth()->user(),
            $this->rejectReason,
        );

        $this->confirmingReject = null;
        $this->rejectReason = '';
        session()->flash('status', 'Penarikan dana ditolak dan saldo dikembalikan.');
    }

    public function buildQuery(): Builder
    {
        return $this->baseQuery()
            ->with([
                'wallet.user',
                'wallet.recentWithdrawals',
                'processedBy',
                'transaction',
            ])
            ->latest();
    }

    public function getStats(): array
    {
        $query = $this->baseQuery();

        return [
            'totalCount' => (clone $query)->count(),
            'pendingCount' => (clone $query)->where('status', WithdrawalStatus::Pending)->count(),
            'completedCount' => (clone $query)->where('status', WithdrawalStatus::Completed)->count(),
            'rejectedCount' => (clone $query)->where('status', WithdrawalStatus::Rejected)->count(),
        ];
    }

    public function render(): View
    {
        $withdrawals = $this->buildQuery()->paginate($this->perPage);
        $stats = $this->getStats();

        return view('livewire.admin.withdrawal-management', [
            'withdrawals' => $withdrawals,
            ...$stats,
        ])->layout('components.layouts.admin');
    }

    protected function baseQuery(): Builder
    {
        $query = WalletWithdrawal::query();

        if ($this->selectedMonth !== '') {
            $query->whereMonth('created_at', (int) $this->selectedMonth);
        }

        if ($this->selectedYear !== '') {
            $query->whereYear('created_at', (int) $this->selectedYear);
        }

        if ($this->search !== '') {
            $query->where(function (Builder $withdrawalQuery): void {
                $withdrawalQuery->whereHas('wallet.user', function (Builder $userQuery): void {
                    $userQuery->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            });
        }

        return $query;
    }
}
