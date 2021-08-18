<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'category_url' => 'required',
            'category_description' => 'required',
            'category_position' => 'required|numeric|min:1',
            'category_icon' => ['image', 'mimes:png,jpg,jpeg', $this->category ?? 'required'],
        ];
    }
}
