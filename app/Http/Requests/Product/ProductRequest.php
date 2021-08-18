<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|max:25',
            'product_category' => 'required',
            'product_label'=> 'required',
            'product_price' => 'required|numeric|min:1',
            'product_description' => 'required|max:255',
            'product_half_image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048', $this->product ?? 'required'],
            'product_full_image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048', $this->product ?? 'required']
        ];
    }
}
