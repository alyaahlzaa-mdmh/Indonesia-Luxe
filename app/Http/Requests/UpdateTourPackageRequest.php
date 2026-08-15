<?php

namespace App\Http\Requests;

use App\Enums\PackageType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTourPackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tour_category_id' => ['required', 'integer', 'exists:tour_categories,id'],
            'type' => ['required', Rule::in(array_map(fn (PackageType $type): string => $type->value, PackageType::cases()))],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'meeting_point' => ['nullable', 'string', 'max:255'],
            'duration_hours' => ['nullable', 'integer', 'min:1'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'price_per_person' => ['required', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }
}
