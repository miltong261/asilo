<?php

namespace App\Http\Requests\Puesto;

use Illuminate\Foundation\Http\FormRequest;

class PuestoRequest extends FormRequest
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
            'nombre' => 'required|min:8|max:35'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'Mínimo',
            'nombre.max' => 'Máximo',
        ];
    }
}
