<?php

namespace App\Http\Controllers;

use App\Enums\WalletTransactionType;
use App\Enums\WithdrawalStatus;
use App\Http\Requests\StoreWalletWithdrawalRequest;
use App\Models\WalletWithdrawal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VendorWalletController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get or create wallet
        $wallet = $user->vendorWallet()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        // Get transaction statistics
        $earningsCount = $wallet->transactions()
            ->where('type', WalletTransactionType::Earning)
            ->count();

        $withdrawalsCount = $wallet->withdrawals()
            ->whereIn('status', ['completed'])
            ->count();

        // Get recent transactions with filter
        $filter = request('filter', 'all'); // all, earning, withdrawal

        $transactionsQuery = $wallet->transactions()
            ->with(['booking.tourPackage', 'withdrawal'])
            ->latest();

        if ($filter === 'earning') {
            $transactionsQuery->where('type', WalletTransactionType::Earning);
        } elseif ($filter === 'withdrawal') {
            $transactionsQuery->where('type', WalletTransactionType::Withdrawal);
        }

        $transactions = $transactionsQuery->paginate(10);

        return view('vendor.wallet.index', [
            'user' => $user,
            'wallet' => $wallet,
            'earningsCount' => $earningsCount,
            'withdrawalsCount' => $withdrawalsCount,
            'transactions' => $transactions,
            'filter' => $filter,
        ]);
    }

    public function withdraw(StoreWalletWithdrawalRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($user, $validated): void {
                $wallet = $user->vendorWallet()->lockForUpdate()->first();

                if (! $wallet || ! $wallet->canWithdraw((float) $validated['amount'])) {
                    throw ValidationException::withMessages([
                        'amount' => 'Saldo tidak mencukupi atau jumlah penarikan tidak valid.',
                    ]);
                }

                $bankDetails = [
                    'bank_name' => $validated['bank_name'],
                    'bank_account_name' => $validated['bank_account_name'],
                    'bank_account_number' => $validated['bank_account_number'],
                ];

                $withdrawal = WalletWithdrawal::create([
                    'vendor_wallet_id' => $wallet->id,
                    'amount' => $validated['amount'],
                    'status' => WithdrawalStatus::Pending,
                    'bank_details' => $bankDetails,
                    'notes' => $validated['notes'] ?? null,
                ]);

                $wallet->decrement('balance', $validated['amount']);
                $wallet->increment('total_withdrawn', $validated['amount']);

                $wallet->transactions()->create([
                    'type' => WalletTransactionType::Withdrawal,
                    'amount' => $validated['amount'],
                    'description' => "Penarikan dana ke {$validated['bank_name']} - {$validated['bank_account_number']}",
                    'withdrawal_id' => $withdrawal->id,
                ]);
            });

            return back()->with('success', 'Permintaan penarikan dana berhasil diajukan. Dana akan diproses dalam 1-3 hari kerja.');
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withErrors(['amount' => 'Terjadi kesalahan saat memproses penarikan dana.']);
        }
    }
}
