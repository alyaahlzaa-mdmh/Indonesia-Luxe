<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGiftCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'unique:gift_cards,code'],
            'value' => ['required', 'numeric', 'min:1000'],
            'expires_at' => ['required', 'date', 'after:today'],
            'max_usages' => ['required', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'Kode gift card sudah digunakan.',
            'code.required' => 'Kode gift card wajib diisi.',
            'value.required' => 'Nominal wajib diisi.',
            'value.min' => 'Nominal minimal Rp 1.000.',
            'expires_at.required' => 'Masa berlaku wajib diisi.',
            'expires_at.after' => 'Masa berlaku harus di masa depan.',
            'max_usages.required' => 'Batas penggunaan wajib diisi.',
        ];
    }
}
