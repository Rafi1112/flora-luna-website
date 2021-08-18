<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_parent' => 'required',
            'item_name' => 'required|max:25',
            'item_stock' => 'required|numeric|min:1',
            'item_price' => 'required|numeric|min:1',
            'item_description' => 'max:255',
            'item_option' => 'max:255',
            'item_icon' => ['image', 'mimes:png,jpg,jpeg', 'max:2048', $this->item ?? 'required']
        ];
    }
}
