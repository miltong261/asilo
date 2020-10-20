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
            'respiraciones' => ['required', 'string'],
            'presion' => ['required', 'string'],
            'pulso' => ['required', 'string'],
            'peso' => ['required', 'numeric'],
            'temperatura' => ['required', 'numeric', 'between:35.5,40.5'],
            'observacion' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'respiraciones.required' => 'Campo obligatorio',

            'presion.required' => 'Campo obligatorio',

            'pulso.required' => 'Campo obligatorio',

            'peso.required' => 'Campo obligatorio',
            'peso.numeric' => 'Solo se permiten números',

            'temperatura.required' => 'Campo obligatorio',
            'temperatura.numeric' => 'Solo se permiten números',
            'temperatura.between' => 'Valores permitidos entre :min - :max.'
        ];
    }
}
