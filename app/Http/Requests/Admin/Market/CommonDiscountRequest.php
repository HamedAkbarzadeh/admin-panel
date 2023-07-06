<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
            'discount_ceiling' => 'required|max:100000000|numeric',
            'minimal_order_amount' => 'required|max:100000000|numeric',
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required|numeric|max:2100500000000',
            'end_date' => 'required|numeric|max:2100500000000',
        ];
    }
}
