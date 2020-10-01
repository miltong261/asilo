<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
            'nombre' => ['required', 'max:35'],
            'descripcion' => ['nullable', 'max:70']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            // 'nombre.exists' => 'El área ya existe',
            'nombre.max' => 'Solo se permiten :max caracteres',

            'descripcion.max' => 'Solo se permiten :max caracteres'
        ];
    }
}
