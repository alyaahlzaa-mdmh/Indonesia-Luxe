<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Enums\OrderStatus;
use App\Enums\PackageStatus;
use App\Enums\PaymentValidationStatus;
use App\Enums\VendorStatus;
use App\Enums\WalletTransactionType;
use App\Enums\WithdrawalStatus;
use App\Models\PaymentSubmission;
use App\Models\TourPackage;
use App\Models\User;
use App\Models\VendorProfile;
use App\Models\VendorWallet;
use App\Models\WalletWithdrawal;
use Illuminate\Support\Facades\DB;

class AdminApprovalService
{
    public function approveVendor(VendorProfile $vendorProfile, User $admin): VendorProfile
    {
        $vendorProfile->status = VendorStatus::Approved;
        $vendorProfile->approved_at = now();
        $vendorProfile->approved_by_user_id = $admin->id;
        $vendorProfile->rejected_reason = null;
        $vendorProfile->save();

        return $vendorProfile;
    }

    public function rejectVendor(VendorProfile $vendorProfile, User $admin, string $reason): VendorProfile
    {
        $vendorProfile->status = VendorStatus::Rejected;
        $vendorProfile->approved_at = null;
        $vendorProfile->approved_by_user_id = $admin->id;
        $vendorProfile->rejected_reason = $reason;
        $vendorProfile->save();

        return $vendorProfile;
    }

    public function approvePackage(TourPackage $tourPackage, User $admin): TourPackage
    {
        $tourPackage->status = PackageStatus::Published;
        $tourPackage->approved_at = now();
        $tourPackage->approved_by_user_id = $admin->id;
        $tourPackage->rejected_reason = null;
        $tourPackage->save();

        return $tourPackage;
    }

    public function rejectPackage(TourPackage $tourPackage, User $admin, string $reason): TourPackage
    {
        $tourPackage->status = PackageStatus::Rejected;
        $tourPackage->approved_at = null;
        $tourPackage->approved_by_user_id = $admin->id;
        $tourPackage->rejected_reason = $reason;
        $tourPackage->save();

        return $tourPackage;
    }

    public function approvePayment(PaymentSubmission $paymentSubmission, User $admin): PaymentSubmission
    {
        return DB::transaction(function () use ($paymentSubmission, $admin): PaymentSubmission {
            $lockedPaymentSubmission = PaymentSubmission::query()
                ->with(['order.items.booking'])
                ->lockForUpdate()
                ->findOrFail($paymentSubmission->id);

            if ($lockedPaymentSubmission->status !== PaymentValidationStatus::Pending) {
                return $lockedPaymentSubmission;
            }

            $lockedPaymentSubmission->status = PaymentValidationStatus::Approved;
            $lockedPaymentSubmission->validated_by_user_id = $admin->id;
            $lockedPaymentSubmission->validated_at = now();
            $lockedPaymentSubmission->rejection_reason = null;
            $lockedPaymentSubmission->save();

            $order = $lockedPaymentSubmission->order;
            $order->status = OrderStatus::Paid;
            $order->paid_at = now();
            $order->save();

            foreach ($order->items as $item) {
                $item->status = BookingStatus::Confirmed;
                $item->save();

                $booking = $item->booking;

                if (! $booking) {
                    continue;
                }

                $booking->status = BookingStatus::Confirmed;
                $booking->confirmed_at = now();
                $booking->save();
            }

            return $lockedPaymentSubmission;
        });
    }

    public function rejectPayment(PaymentSubmission $paymentSubmission, User $admin, string $reason): PaymentSubmission
    {
        return DB::transaction(function () use ($paymentSubmission, $admin, $reason): PaymentSubmission {
            $lockedPaymentSubmission = PaymentSubmission::query()
                ->with('order')
                ->lockForUpdate()
                ->findOrFail($paymentSubmission->id);

            if ($lockedPaymentSubmission->status !== PaymentValidationStatus::Pending) {
                return $lockedPaymentSubmission;
            }

            $lockedPaymentSubmission->status = PaymentValidationStatus::Rejected;
            $lockedPaymentSubmission->validated_by_user_id = $admin->id;
            $lockedPaymentSubmission->validated_at = now();
            $lockedPaymentSubmission->rejection_reason = $reason;
            $lockedPaymentSubmission->save();

            $order = $lockedPaymentSubmission->order;
            $order->status = OrderStatus::PendingPayment;
            $order->save();

            return $lockedPaymentSubmission;
        });
    }

    public function approveWithdrawal(WalletWithdrawal $withdrawal, User $admin): WalletWithdrawal
    {
        return DB::transaction(function () use ($withdrawal, $admin): WalletWithdrawal {
            $lockedWithdrawal = WalletWithdrawal::query()
                ->with(['wallet.user', 'processedBy', 'transaction'])
                ->lockForUpdate()
                ->findOrFail($withdrawal->id);

            if (! $lockedWithdrawal->isPending()) {
                return $lockedWithdrawal;
            }

            $lockedWithdrawal->status = WithdrawalStatus::Completed;
            $lockedWithdrawal->processed_by_user_id = $admin->id;
            $lockedWithdrawal->processed_at = now();
            $lockedWithdrawal->rejection_reason = null;
            $lockedWithdrawal->save();

            $lockedWithdrawal->transaction?->update([
                'description' => $this->formatWithdrawalTransactionDescription(
                    $lockedWithdrawal,
                    WalletTransactionType::Withdrawal,
                    null
                ),
            ]);

            return $lockedWithdrawal;
        });
    }

    public function rejectWithdrawal(WalletWithdrawal $withdrawal, User $admin, string $reason): WalletWithdrawal
    {
        return DB::transaction(function () use ($withdrawal, $admin, $reason): WalletWithdrawal {
            $lockedWithdrawal = WalletWithdrawal::query()
                ->with(['wallet.user', 'processedBy', 'transaction'])
                ->lockForUpdate()
                ->findOrFail($withdrawal->id);

            if (! $lockedWithdrawal->isPending()) {
                return $lockedWithdrawal;
            }

            $wallet = VendorWallet::query()
                ->lockForUpdate()
                ->findOrFail($lockedWithdrawal->vendor_wallet_id);

            $lockedWithdrawal->status = WithdrawalStatus::Rejected;
            $lockedWithdrawal->rejection_reason = $reason;
            $lockedWithdrawal->processed_by_user_id = $admin->id;
            $lockedWithdrawal->processed_at = now();
            $lockedWithdrawal->save();

            $wallet->increment('balance', $lockedWithdrawal->amount);
            $wallet->decrement('total_withdrawn', $lockedWithdrawal->amount);

            if ($lockedWithdrawal->transaction) {
                $lockedWithdrawal->transaction->update([
                    'description' => $this->formatWithdrawalTransactionDescription(
                        $lockedWithdrawal,
                        WalletTransactionType::Withdrawal,
                        $reason
                    ),
                ]);
            }

            return $lockedWithdrawal->fresh(['wallet.user', 'processedBy', 'transaction']);
        });
    }

    private function formatWithdrawalTransactionDescription(
        WalletWithdrawal $withdrawal,
        WalletTransactionType $type,
        ?string $reason,
    ): string {
        if ($type !== WalletTransactionType::Withdrawal) {
            return (string) $withdrawal->transaction?->description;
        }

        $bankDetails = $withdrawal->bank_details ?? [];
        $bankName = $bankDetails['bank_name'] ?? 'Bank tidak diketahui';
        $accountNumber = $bankDetails['bank_account_number'] ?? '-';
        $baseDescription = "Penarikan dana ke {$bankName} - {$accountNumber}";

        if ($reason === null) {
            return $baseDescription.' (disetujui admin)';
        }

        return $baseDescription." (ditolak admin: {$reason})";
    }
}
