<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MonthlyReport extends Component
{
    use \App\Livewire\Admin\Concerns\WithAdminFilters;
    use \App\Livewire\Admin\Concerns\WithAdminPagination;

    public int $selectedMonth;

    public int $selectedYear;

    /**
     * @var array<int, string>
     */
    public array $months = [];

    /**
     * @var list<int>
     */
    public array $years = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedMonth' => ['except' => ''],
        'selectedYear' => ['except' => ''],
    ];

    public function updatedSelectedMonth(): void
    {
        $this->resetPage();
        $this->dispatch('refreshCharts');
    }

    public function updatedSelectedYear(): void
    {
        $this->resetPage();
        $this->dispatch('refreshCharts');
    }

    public function mount(): void
    {
        $this->selectedMonth = (int) request('selectedMonth', now()->month);
        $this->selectedYear = (int) request('selectedYear', now()->year);
        $this->search = request('search', '');

        $this->months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $this->years = range(now()->year, now()->year - 5);
    }

    public function exportPdf(ReportService $reportService): StreamedResponse
    {
        $report = $reportService->adminMonthly($this->selectedPeriod());

        $pdf = Pdf::loadView('admin.reports.pdf.monthly', [
            'report' => $report,
        ]);

        $filename = "ILT_Laporan_{$report['month_name']}_{$report['year']}.pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function render(ReportService $reportService): View
    {
        $report = $reportService->adminMonthly($this->selectedPeriod());
        $orders = $this->ordersQuery($report['from'], $report['to'])->paginate($this->perPage);

        return view('livewire.admin.monthly-report', [
            'report' => $report,
            'orders' => $orders,
        ])->layout('components.layouts.admin');
    }

    private function selectedPeriod(): Carbon
    {
        return Carbon::create($this->selectedYear, $this->selectedMonth, 1)->startOfMonth();
    }

    private function ordersQuery(Carbon $from, Carbon $to): Builder
    {
        $query = Order::query()
            ->with(['user', 'items.tourPackage'])
            ->whereBetween('created_at', [$from, $to])
            ->latest();

        if ($this->search) {
            $query->where(function (Builder $orderQuery): void {
                $orderQuery->whereHas('user', function (Builder $userQuery): void {
                    $userQuery->where('name', 'like', '%'.$this->search.'%');
                })->orWhereHas('items', function (Builder $itemQuery): void {
                    $itemQuery->where('package_title', 'like', '%'.$this->search.'%');
                });
            });
        }

        return $query;
    }
}
