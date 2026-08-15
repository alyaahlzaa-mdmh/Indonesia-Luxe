<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'business_name' => 'required|string|max:255',
            'business_description' => 'required|string|max:2000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'business_name.required' => 'Nama bisnis wajib diisi.',
            'business_name.max' => 'Nama bisnis maksimal 255 karakter.',
            'business_description.required' => 'Deskripsi bisnis wajib diisi.',
            'business_description.max' => 'Deskripsi bisnis maksimal 2000 karakter.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'avatar.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama lengkap',
            'phone' => 'nomor telepon',
            'business_name' => 'nama bisnis',
            'business_description' => 'deskripsi bisnis',
            'avatar' => 'foto profil',
        ];
    }
}
