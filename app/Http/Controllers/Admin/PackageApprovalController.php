<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePackageApprovalRequest;
use App\Models\TourPackage;
use App\Services\AdminApprovalService;

class PackageApprovalController extends Controller
{
    public function __construct(private readonly AdminApprovalService $adminApprovalService)
    {
    }

    public function index()
    {
        $tourPackages = TourPackage::query()
            ->with(['vendor', 'category'])
            ->latest()
            ->paginate(20);

        return view('admin.packages.index', [
            'tourPackages' => $tourPackages,
        ]);
    }

    public function update(UpdatePackageApprovalRequest $request, TourPackage $tourPackage)
    {
        if ($request->validated('action') === 'approve') {
            $this->adminApprovalService->approvePackage($tourPackage, auth()->user());
        }

        if ($request->validated('action') === 'reject') {
            $this->adminApprovalService->rejectPackage(
                $tourPackage,
                auth()->user(),
                $request->validated('reason'),
            );
        }

        return back()->with('status', 'Status paket berhasil diperbarui.');
    }
}
