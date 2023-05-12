<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'name' => ['string', 'required'],
            'description' => ['string', 'required'],
            'type' => ['required', 'string'],
            'amount' => ['numeric', 'required'],
            'menu_item_id' => ['required', 'exists:menu_items,id'],
            'start_at' => ['required'],
            'end_at' => ['required', 'after:start_at'],
        ];
    }
}
