<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBilling extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'working_days_rate' => 'required|numeric|min:0|max:1',
            'weekend_rate' => 'required|numeric|min:0|max:1',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nazwa billingu',
            'working_days_rate' => 'Opłata za dni robocze',
            'weekend_rate' => 'Opłata za sobotę',
        ];
    }
}
