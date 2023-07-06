<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CopanRequest extends FormRequest
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
            'amount_type' => 'required|numeric|in:0,1',
            'type' => 'required|numeric|in:0,1',
            // 'user_id' => 'nullable|min:1|max:100000000|regex:/^[0-9]+$/u|exists:users,id',
            'user_id' => [(request()->type == 0) ? 'nullable' : 'required', 'min:1' , 'max:100000000' , 'regex:/^[0-9]+$/u' ,'exists:users,id'],
            'code' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟ ]+$/u',
            // 'amount_percentage' => 'nullable|numeric|max:100',
            // 'amount_price' => 'nullable|numeric|max:10000000',
            'amount' => [(request()->amount_type == 0) ? 'max:100' : 'max:10000000000' , 'required' , 'numeric'],
            'discount_ceiling' => 'required|numeric|max:10000000',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
