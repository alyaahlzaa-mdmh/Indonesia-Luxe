<?php

namespace App\Livewire\Admin;

use App\Enums\PaymentValidationStatus;
use App\Livewire\Admin\Concerns\WithAdminFilters;
use App\Livewire\Admin\Concerns\WithAdminPagination;
use App\Models\PaymentSubmission;
use App\Services\AdminApprovalService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;

class PaymentValidation extends Component
{
    use WithAdminFilters, WithAdminPagination;

    public $expandedPaymentId = null;

    public $confirmingReject = null;

    public string $rejectReason = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function toggleExpand(int $paymentId): void
    {
        if ($this->expandedPaymentId === $paymentId) {
            $this->expandedPaymentId = null;
        } else {
            $this->expandedPaymentId = $paymentId;
        }
    }

    public function approve(int $paymentId): void
    {
        $payment = PaymentSubmission::findOrFail($paymentId);

        if ($payment->status !== PaymentValidationStatus::Pending) {
            return;
        }

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->approvePayment($payment, auth()->user());

        session()->flash('status', 'Pembayaran berhasil disetujui.');
    }

    public function confirmReject(int $paymentId): void
    {
        $payment = PaymentSubmission::findOrFail($paymentId);

        if ($payment->status !== PaymentValidationStatus::Pending) {
            return;
        }

        $this->confirmingReject = $paymentId;
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

        $payment = PaymentSubmission::findOrFail($this->confirmingReject);

        if ($payment->status !== PaymentValidationStatus::Pending) {
            $this->confirmingReject = null;
            $this->rejectReason = '';

            return;
        }

        $adminApprovalService = app(AdminApprovalService::class);
        $adminApprovalService->rejectPayment($payment, auth()->user(), $this->rejectReason);

        $this->confirmingReject = null;
        $this->rejectReason = '';
        session()->flash('status', 'Pembayaran ditolak.');
    }

    public function buildQuery(): Builder
    {
        $query = PaymentSubmission::query()
            ->with(['order.user', 'order.items.tourPackage', 'submittedBy'])
            ->latest();

        if ($this->search) {
            $query->where(function ($paymentQuery) {
                $paymentQuery->whereHas('submittedBy', function ($userQuery) {
                    $userQuery->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                })->orWhereHas('order', function ($orderQuery) {
                    $orderQuery->where('code', 'like', '%'.$this->search.'%');
                });
            });
        }

        return $query;
    }

    public function render(): View
    {
        $payments = $this->buildQuery()->paginate($this->perPage);
        $pendingCount = PaymentSubmission::where('status', PaymentValidationStatus::Pending)->count();

        return view('livewire.admin.payment-validation', [
            'payments' => $payments,
            'totalCount' => PaymentSubmission::count(),
            'pendingCount' => $pendingCount,
        ])->layout('components.layouts.admin');
    }
}
