<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditableUpdateProviderMargin extends FormRequest
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
            'value' => 'required|numeric|regex:#^(?:\d{0,4})(?:\.\d{0,4})?$#s',
        ];
    }

    public function attributes()
    {
        return [
            'value' => 'Marża',
        ];
    }
}
