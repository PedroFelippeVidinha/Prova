<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'cpf' => 'required|string|max:20',
            'email' => 'required|string|max:50',
            'date_birth' => 'required|string|max:10',
            'nationality' => 'required|string|max:20',
            'phones' => 'array|nullable'
        ];
    }
}
