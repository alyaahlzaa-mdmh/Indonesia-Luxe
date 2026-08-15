<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePromoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'unique:promos,code'],
            'description' => ['required', 'string', 'max:255'],
            'group' => ['nullable', 'string', 'max:100'],
            'discount_type' => ['required', 'in:percent,flat'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'min_purchase' => ['nullable', 'numeric', 'min:0'],
            'category_restriction' => ['nullable', 'string', 'max:100', Rule::exists('tour_categories', 'name')],
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'Kode promo sudah digunakan.',
            'code.required' => 'Kode promo wajib diisi.',
            'description.required' => 'Deskripsi promo wajib diisi.',
            'discount_type.required' => 'Tipe diskon wajib dipilih.',
            'discount_value.required' => 'Nilai diskon wajib diisi.',
            'valid_until.after_or_equal' => 'Tanggal akhir harus setelah tanggal mulai.',
        ];
    }
}
