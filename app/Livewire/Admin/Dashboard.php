<?php

namespace App\Livewire\Admin;

use App\Enums\OrderStatus;
use App\Enums\PaymentValidationStatus;
use App\Enums\UserRole;
use App\Enums\VendorStatus;
use App\Livewire\Admin\Concerns\WithAdminFilters;
use App\Livewire\Admin\Concerns\WithAdminPagination;
use App\Models\Order;
use App\Models\PaymentSubmission;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    use WithAdminFilters, WithAdminPagination;

    public function renderData(): LengthAwarePaginator
    {
        $query = Order::query()
            ->with(['user', 'paymentSubmissions' => function ($paymentQuery) {
                $paymentQuery->latest();
            }])
            ->latest();

        if ($this->search) {
            $query->where(function ($orderQuery) {
                $orderQuery->whereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                })->orWhere('code', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query->paginate($this->perPage);
    }

    protected function getMonthlyTrend(): Collection
    {
        return collect(range(5, 0))
            ->map(function (int $monthOffset): array {
                $month = now()->copy()->subMonths($monthOffset);
                $startOfMonth = $month->copy()->startOfMonth();
                $endOfMonth = $month->copy()->endOfMonth();

                return [
                    'label' => $month->locale('id')->translatedFormat('M'),
                    'revenue' => (float) Order::query()
                        ->whereIn('status', [
                            OrderStatus::Paid->value,
                            OrderStatus::PartiallyConfirmed->value,
                            OrderStatus::Completed->value,
                        ])
                        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->sum('total_amount'),
                    'transactions' => (int) Order::query()
                        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->count(),
                ];
            })
            ->values();
    }

    /**
     * @return array{
     *     labels: list<string>,
     *     revenue: list<float>,
     *     transactions: list<int>,
     *     maxTransactions: int
     * }
     */
    protected function buildTrendChart(Collection $monthlyTrend): array
    {
        $transactionValues = $monthlyTrend
            ->pluck('transactions')
            ->map(fn (mixed $value): int => (int) $value)
            ->all();

        return [
            'labels' => $monthlyTrend->pluck('label')->all(),
            'revenue' => $monthlyTrend
                ->pluck('revenue')
                ->map(fn (mixed $value): float => (float) $value)
                ->all(),
            'transactions' => $transactionValues,
            'maxTransactions' => $this->resolveTransactionScale($transactionValues),
        ];
    }

    /**
     * @param  list<int>  $values
     */
    protected function resolveTransactionScale(array $values): int
    {
        $highestValue = max($values ?: [0]);

        return max(8, (int) ceil($highestValue / 2) * 2);
    }

    public function render(): View
    {
        $monthlyTrend = $this->getMonthlyTrend();

        return view('livewire.admin.dashboard', [
            'totalUsers' => User::query()->where('role', UserRole::Customer->value)->count(),
            'totalVendors' => VendorProfile::query()->count(),
            'pendingVendors' => VendorProfile::query()->where('status', VendorStatus::Pending->value)->count(),
            'pendingPackages' => TourPackage::pendingApproval()->count(),
            'liveTours' => TourPackage::published()->count(),
            'totalTransactions' => Order::query()->count(),
            'pendingPayments' => PaymentSubmission::query()->where('status', PaymentValidationStatus::Pending->value)->count(),
            'pendingOrderCount' => Order::query()
                ->whereIn('status', [
                    OrderStatus::PendingPayment->value,
                    OrderStatus::AwaitingValidation->value,
                ])
                ->count(),
            'totalRevenue' => Order::query()
                ->whereIn('status', [
                    OrderStatus::Paid->value,
                    OrderStatus::PartiallyConfirmed->value,
                    OrderStatus::Completed->value,
                ])
                ->sum('total_amount'),
            'trendChart' => $this->buildTrendChart($monthlyTrend),
            'recentOrders' => $this->renderData(),
        ]);
    }
}
