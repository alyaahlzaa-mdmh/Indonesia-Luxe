<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletWithdrawalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'numeric',
                'min:50000',
                'max:'.(auth()->user()->vendorWallet->balance ?? 0),
            ],
            'bank_name' => 'required|string|max:255',
            'bank_account_name' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:50',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Jumlah penarikan wajib diisi.',
            'amount.numeric' => 'Jumlah penarikan harus berupa angka.',
            'amount.min' => 'Jumlah penarikan minimal Rp 50.000.',
            'amount.max' => 'Jumlah penarikan melebihi saldo yang tersedia.',
            'bank_name.required' => 'Nama bank wajib diisi.',
            'bank_account_name.required' => 'Nama pemilik rekening wajib diisi.',
            'bank_account_number.required' => 'Nomor rekening wajib diisi.',
            'notes.max' => 'Catatan maksimal 1000 karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'amount' => 'jumlah penarikan',
            'bank_name' => 'nama bank',
            'bank_account_name' => 'nama pemilik rekening',
            'bank_account_number' => 'nomor rekening',
            'notes' => 'catatan',
        ];
    }
}
