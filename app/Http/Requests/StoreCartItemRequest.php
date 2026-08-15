<?php

namespace App\Http\Requests;

use App\Models\TourDepartureSlot;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCartItemRequest extends FormRequest
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
            'tour_departure_slot_id' => ['required', 'integer', 'exists:tour_departure_slots,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'pickup_point' => [
                Rule::requiredIf(function () {
                    $slotId = $this->input('tour_departure_slot_id');
                    $slot = TourDepartureSlot::query()->with('tourPackage.vendor')->find($slotId);

                    if ($slot === null) {
                        return false;
                    }

                    return $slot->tourPackage->vendor?->isAdmin()
                        || $slot->tourPackage->pickupPoints()->exists();
                }),
                'nullable',
                'string',
                'max:255',
            ],
            'redirect_to' => ['nullable', 'string', 'in:checkout'],
        ];
    }
}
