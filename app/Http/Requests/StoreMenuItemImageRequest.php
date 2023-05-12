<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemImageRequest extends FormRequest
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
           'image' => 'required|file|image',
           'menu_item_id' => 'required|exists:menu_items,id',
        ];
    }
}
