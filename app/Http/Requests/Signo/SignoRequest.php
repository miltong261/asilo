<?php

namespace App\Http\Requests\Signo;

use Illuminate\Foundation\Http\FormRequest;

class SignoRequest extends FormRequest
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
            'respiraciones' => ['required', 'integer'],
            'presion' => ['required', 'string'],
            'pulso' => ['required', 'numeric'],
            'peso' => ['required', 'numeric'],
            'temperatura' => ['required', 'numeric', 'between:35.5,41.0'],
            'observacion' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'respiraciones.required' => 'Campo obligatorio',
            'respiraciones.numeric' => 'Solo se permiten números enteros',

            'presion.required' => 'Campo obligatorio',

            'pulso.required' => 'Campo obligatorio',

            'temperatura.required' => 'Campo obligatorio',
            'temperatura.numeric' => 'Solo se permiten números',
            'temperatura.between' => 'Tiene que estar entre :min - :max.'
        ];
    }
}
