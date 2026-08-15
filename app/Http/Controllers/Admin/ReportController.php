<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(private readonly ReportService $reportService)
    {
    }

    public function __invoke()
    {
        $report = $this->reportService->adminMonthly();

        return view('admin.reports.monthly', [
            'report' => $report,
        ]);
    }
}
