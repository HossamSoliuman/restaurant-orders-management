<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
            'items' => [ 'array', 'min:1'],
            'items.*.id' => ['integer', Rule::exists('menu_items', 'id')],
            'items.*.quantity' => ['integer', 'min:1'],
            'status' => ['string'],    
        ];
    }
}
