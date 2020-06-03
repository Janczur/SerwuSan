<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Imports\Strategies\ProviderMargin;

class StoreProviderMargin extends FormRequest
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
            'import_file' => 'required|file|mimes:txt,csv,xlsx',
            ProviderMargin::FORM_NAME => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'import_file' => 'Importowany plik',
            ProviderMargin::FORM_NAME => 'Strategia importu'
        ];
    }
}
