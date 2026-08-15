<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendorApprovalRequest;
use App\Models\VendorProfile;
use App\Services\AdminApprovalService;

class VendorApprovalController extends Controller
{
    public function __construct(private readonly AdminApprovalService $adminApprovalService)
    {
    }

    public function index()
    {
        $vendorProfiles = VendorProfile::query()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.vendors.index', [
            'vendorProfiles' => $vendorProfiles,
        ]);
    }

    public function update(UpdateVendorApprovalRequest $request, VendorProfile $vendorProfile)
    {
        if ($request->validated('action') === 'approve') {
            $this->adminApprovalService->approveVendor($vendorProfile, auth()->user());
        }

        if ($request->validated('action') === 'reject') {
            $this->adminApprovalService->rejectVendor(
                $vendorProfile,
                auth()->user(),
                $request->validated('reason'),
            );
        }

        return back()->with('status', 'Status vendor berhasil diperbarui.');
    }
}
