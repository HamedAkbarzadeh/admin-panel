<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'persian_name' => 'required|min:2|max:10000',
            'original_name' => 'required|min:2|max:10000',
            'logo' => 'required|min:2|max:1000',
            'status' => 'required|in:1,2',
            'tags' => 'required|min:2|max:10000',
        ];
    }
}
