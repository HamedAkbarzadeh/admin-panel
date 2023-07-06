<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class AmazingSaleRequest extends FormRequest
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
            'percentage' => 'required|max:100|numeric',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required|numeric|max:2100500000000',
            'end_date' => 'required|numeric|max:2100500000000',
            'status' => 'required|numeric|in:0,1',
            'product_id' => 'required|numeric|exists:products,id'
        ];
    }
}
