<?php

namespace App\Http\Requests\Admin\Market;

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
            'name' => 'required|min:2|max:100000',
            'description' => 'required|min:2|max:100000',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'status' => 'required|numeric|in:0,1',
            'show_in_menu' => 'required|numeric|in:0,1',
            'tags' => 'required|min:2|max:100000',
            'parent_id' => 'nullable|min:0|exists:product_categories,id'
        ];
    }
}
