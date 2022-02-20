<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'title' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O título é um campo de preenchimento obrigatório!',
            'title.min' => 'O campo título deve conter no mínimo 3 caracteres!'
        ];
    }
}
