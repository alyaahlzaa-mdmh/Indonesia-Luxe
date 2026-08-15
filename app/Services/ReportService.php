<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Enums\UserRole;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * @return array<string, mixed>
     */
    public function vendorSales(User $vendor, ?Carbon $from = null, ?Carbon $to = null): array
    {
        $from ??= now()->startOfMonth();
        $to ??= now()->endOfMonth();

        $query = OrderItem::query()
            ->where('vendor_id', $vendor->id)
            ->whereHas('order', function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to]);
            })
            ->with(['order.user', 'tourPackage']);

        $items = $query->latest()->get();
        $paidItems = $items->whereIn('order.status', $this->revenueStatuses());

        $totalRevenue = (float) $paidItems->sum('line_total');
        $totalItems = (int) $paidItems->sum('quantity');
        $totalOrders = (int) $paidItems->pluck('order_id')->unique()->count();
        $totalTransactions = $items->count();
        $confirmedCount = $items->whereIn('order.status', $this->revenueStatuses())->count();
        $pendingCount = $items->where('order.status', OrderStatus::PendingPayment)->count();
        $awaitingValidationCount = $items->where('order.status', OrderStatus::AwaitingValidation)->count();
        $conversionRate = $totalTransactions > 0 ? ($confirmedCount / $totalTransactions) * 100 : 0;

        return [
            'from' => $from,
            'to' => $to,
            'total_revenue' => $totalRevenue,
            'total_items' => $totalItems,
            'total_orders' => $totalOrders,
            'total_transactions' => $totalTransactions,
            'confirmed_count' => $confirmedCount,
            'pending_count' => $pendingCount,
            'awaiting_validation_count' => $awaitingValidationCount,
            'conversion_rate' => $conversionRate,
            'items' => $items,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function adminMonthly(?Carbon $month = null): array
    {
        $month ??= now();

        $from = $month->copy()->startOfMonth();
        $to = $month->copy()->endOfMonth();
        $ordersQuery = $this->ordersForPeriodQuery($from, $to);

        $totalTransactions = (int) (clone $ordersQuery)->count();
        $confirmedCount = (int) (clone $ordersQuery)
            ->whereIn('status', $this->revenueStatusValues())
            ->count();
        $pendingCount = (int) (clone $ordersQuery)
            ->whereIn('status', $this->pendingStatusValues())
            ->count();
        $totalRevenue = (float) (clone $ordersQuery)
            ->whereIn('status', $this->revenueStatusValues())
            ->sum('total_amount');

        $categoryDistribution = TourCategory::query()
            ->withCount('tourPackages')
            ->orderBy('name')
            ->get()
            ->map(fn (TourCategory $category): array => [
                'name' => $category->name,
                'count' => $category->tour_packages_count,
            ])
            ->values()
            ->all();

        $driver = $ordersQuery->getQuery()->getConnection()->getDriverName();
        $dayExpression = $driver === 'sqlite'
            ? "CAST(strftime('%d', created_at) AS INTEGER)"
            : 'DAY(created_at)';

        $dailyStats = (clone $ordersQuery)
            ->selectRaw("{$dayExpression} as day")
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw(sprintf(
                'SUM(CASE WHEN status IN (%s) THEN total_amount ELSE 0 END) as revenue',
                $this->quotedStatusList($this->revenueStatusValues()),
            ))
            ->groupBy('day')
            ->get()
            ->keyBy('day');

        $dailyTrends = $this->buildDailyTrends($from, $dailyStats);
        $statusDistribution = $this->buildStatusDistribution($ordersQuery);

        $totalUsers = User::query()->where('role', UserRole::Customer->value)->count();
        $totalVendors = User::query()->where('role', UserRole::Vendor->value)->count();
        $totalTours = TourPackage::query()->count();
        $approvedTours = TourPackage::query()->where('status', PackageStatus::Published->value)->count();
        $globalTotalRevenue = (float) Order::query()
            ->whereIn('status', $this->revenueStatusValues())
            ->sum('total_amount');
        $globalTotalOrders = (int) Order::count();
        $monthName = $this->monthName($from);

        return [
            'month' => $monthName.' '.$from->format('Y'),
            'month_name' => $monthName,
            'year' => $from->format('Y'),
            'from' => $from,
            'to' => $to,
            'total_transactions' => $totalTransactions,
            'total_revenue' => $totalRevenue,
            'confirmed_count' => $confirmedCount,
            'pending_count' => $pendingCount,
            'active_days' => $dailyStats->count(),
            'total_users' => $totalUsers,
            'total_vendors' => $totalVendors,
            'total_tours' => $totalTours,
            'approved_tours' => $approvedTours,
            'global_total_revenue' => $globalTotalRevenue,
            'global_total_orders' => $globalTotalOrders,
            'category_distribution' => $categoryDistribution,
            'daily_trends' => $dailyTrends,
            'status_distribution' => $statusDistribution,
            'orders' => $this->ordersForPeriodQuery($from, $to)
                ->with(['user', 'items.tourPackage'])
                ->get(),
            'chart_payload' => [
                'daily_trends' => $dailyTrends,
                'status_distribution' => $statusDistribution,
                'category_distribution' => $categoryDistribution,
            ],
        ];
    }

    private function ordersForPeriodQuery(Carbon $from, Carbon $to): Builder
    {
        return Order::query()->whereBetween('created_at', [$from, $to]);
    }

    /**
     * @param  Collection<int, object>  $dailyStats
     * @return list<array{day:int, transactions:int, revenue:float}>
     */
    private function buildDailyTrends(Carbon $from, Collection $dailyStats): array
    {
        $dailyTrends = [];

        for ($day = 1; $day <= $from->daysInMonth; $day++) {
            $dailyTrends[] = [
                'day' => $day,
                'transactions' => $dailyStats->has($day) ? (int) $dailyStats[$day]->total_orders : 0,
                'revenue' => $dailyStats->has($day) ? (float) $dailyStats[$day]->revenue : 0.0,
            ];
        }

        return $dailyTrends;
    }

    /**
     * @return array{
     *     approved: array{count:int, percentage:int},
     *     pending: array{count:int, percentage:int},
     *     rejected: array{count:int, percentage:int}
     * }
     */
    private function buildStatusDistribution(Builder $ordersQuery): array
    {
        $statusStats = (clone $ordersQuery)
            ->toBase()
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        $approvedCount = (int) collect($this->revenueStatusValues())
            ->sum(fn (string $status): int => (int) ($statusStats[$status] ?? 0));
        $pendingCount = (int) collect($this->pendingStatusValues())
            ->sum(fn (string $status): int => (int) ($statusStats[$status] ?? 0));
        $rejectedCount = (int) ($statusStats[OrderStatus::Cancelled->value] ?? 0);
        $total = max(1, $approvedCount + $pendingCount + $rejectedCount);

        return [
            'approved' => [
                'count' => $approvedCount,
                'percentage' => (int) round(($approvedCount / $total) * 100),
            ],
            'pending' => [
                'count' => $pendingCount,
                'percentage' => (int) round(($pendingCount / $total) * 100),
            ],
            'rejected' => [
                'count' => $rejectedCount,
                'percentage' => (int) round(($rejectedCount / $total) * 100),
            ],
        ];
    }

    /**
     * @return list<OrderStatus>
     */
    private function revenueStatuses(): array
    {
        return [
            OrderStatus::Paid,
            OrderStatus::PartiallyConfirmed,
            OrderStatus::Completed,
        ];
    }

    /**
     * @return list<string>
     */
    private function revenueStatusValues(): array
    {
        return array_map(
            static fn (OrderStatus $status): string => $status->value,
            $this->revenueStatuses(),
        );
    }

    /**
     * @return list<string>
     */
    private function pendingStatusValues(): array
    {
        return [
            OrderStatus::PendingPayment->value,
            OrderStatus::AwaitingValidation->value,
        ];
    }

    /**
     * @param  list<string>  $statuses
     */
    private function quotedStatusList(array $statuses): string
    {
        return collect($statuses)
            ->map(static fn (string $status): string => "'".$status."'")
            ->implode(', ');
    }

    private function monthName(Carbon $month): string
    {
        return match ((int) $month->format('n')) {
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        };
    }
}
