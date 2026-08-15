<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePaymentValidationRequest;
use App\Models\PaymentSubmission;
use App\Services\AdminApprovalService;

class PaymentValidationController extends Controller
{
    public function __construct(private readonly AdminApprovalService $adminApprovalService)
    {
    }

    public function index()
    {
        $paymentSubmissions = PaymentSubmission::query()
            ->with(['order', 'submittedBy'])
            ->latest()
            ->paginate(20);

        return view('admin.payments.index', [
            'paymentSubmissions' => $paymentSubmissions,
        ]);
    }

    public function update(UpdatePaymentValidationRequest $request, PaymentSubmission $paymentSubmission)
    {
        if ($request->validated('action') === 'approve') {
            $this->adminApprovalService->approvePayment($paymentSubmission, auth()->user());
        }

        if ($request->validated('action') === 'reject') {
            $this->adminApprovalService->rejectPayment(
                $paymentSubmission,
                auth()->user(),
                $request->validated('reason'),
            );
        }

        return back()->with('status', 'Status pembayaran berhasil diperbarui.');
    }
}
