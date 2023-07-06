<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class AddStoreRequest extends FormRequest
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
            'receiver' => 'required|max:1220|min:2',
            'delivery' => 'required|max:1220|min:2',
            'description' => 'required|max:1220|min:2',
            'marketable_number' => 'required|numeric|max:10000'
        ];
    }
}
