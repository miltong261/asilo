<?php

namespace App\Http\Requests\Donante;

use Illuminate\Foundation\Http\FormRequest;

class DonanteRequest extends FormRequest
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
            'nombre' => ['nullable', 'string', 'max:70'],
            'direccion' => ['nullable', 'max:70'],
            'telefono' => ['nullable', 'digits:8']
        ];
    }

    public function messages()
    {
        return [
            'nombre.string' => 'Solo se permiten caracteres',
            'nombre.max' => 'El nombre debe contener como máximo :max caracteres',

            'direccion.string' => 'La direccion debe contener como máximo :max caracteres',

            'telefono.digits' => 'El número de teléfono solo contiene 8 dígitos'
        ];
    }
}
