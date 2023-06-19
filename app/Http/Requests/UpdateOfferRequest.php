<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['string', 'nullable'],
            'description' => ['string', 'nullable'],
            'type' => ['nullable', 'string'],
            'amount' => ['numeric', 'nullable', 'min:0'],
            'menu_item_id' => ['nullable', 'exists:menu_items,id'],
            'start_at' => ['nullable', 'after_or_equal:now'],
            'end_at' => ['nullable', 'after:start_at'],
        ];
    }
}
