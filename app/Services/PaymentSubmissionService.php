<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentValidationStatus;
use App\Models\Order;
use App\Models\PaymentSubmission;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PaymentSubmissionService
{
    /**
     * @param  array<string, string|null>  $data
     */
    public function submit(Order $order, User $submittedBy, UploadedFile $proofFile, array $data = []): PaymentSubmission
    {
        $path = $proofFile->store('payment-proofs/'.$order->id, 'public');

        $submission = PaymentSubmission::query()->create([
            'order_id' => $order->id,
            'submitted_by_user_id' => $submittedBy->id,
            'status' => PaymentValidationStatus::Pending,
            'proof_path' => $path,
            'bank_sender_name' => $data['bank_sender_name'] ?? null,
            'bank_sender_account' => $data['bank_sender_account'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        $order->status = OrderStatus::AwaitingValidation;
        $order->save();

        return $submission;
    }

    public function proofUrl(PaymentSubmission $paymentSubmission): string
    {
        return Storage::disk('public')->url($paymentSubmission->proof_path);
    }
}
