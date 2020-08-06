<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvidersPricelist extends FormRequest
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
            'importFile' => 'required|file|mimes:txt,csv,xlsx'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nazwa cennika',
            'import_file' => 'Importowany plik',
        ];
    }
}
