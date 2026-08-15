<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct(private readonly ReportService $reportService) {}

    public function __invoke()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $report = $this->reportService->vendorSales($user);

        return view('vendor.reports.sales', [
            'report' => (object) $report,
        ]);
    }

    public function export()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $report = $this->reportService->vendorSales($user);

        $pdf = Pdf::loadView('vendor.reports.sales-pdf', [
            'report' => (object) $report,
        ]);

        return $pdf->download('sales-report-'.now()->format('Y-m-d').'.pdf');
    }
}
