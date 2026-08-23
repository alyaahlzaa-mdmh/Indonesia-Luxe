<?php

namespace App\Http\Requests;

use App\Enums\PackageType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTourPackageRequest extends FormRequest
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
            'price_per_person' => ['required', 'numeric', 'min:0'],
            'duration_hours' => ['nullable', 'integer', 'min:1'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'cover_image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'extra_photos' => ['nullable', 'array', 'max:4'],
            'extra_photos.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'highlights' => ['nullable', 'array'],
            'highlights.*' => ['nullable', 'string', 'max:255'],
            'included' => ['nullable', 'array'],
            'included.*' => ['nullable', 'string', 'max:255'],
            'itineraries' => ['nullable', 'array'],
            'itineraries.*.description' => ['nullable', 'string'],
            'pickup_points' => ['nullable', 'array'],
            'pickup_points.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'pickup_points' => 'titik penjemputan',
            'itineraries.*.description' => 'deskripsi itinerary',
            'extra_photos' => 'foto tambahan',
            'extra_photos.*' => 'foto tambahan',
        ];
    }
}
