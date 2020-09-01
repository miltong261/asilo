<?php

namespace App\Http\Requests\Example;

use Illuminate\Foundation\Http\FormRequest;

class ExampleRequest extends FormRequest
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
            'nombre' => 'required|min:5|max:35',
            'direccion' =>  'required|min:5|max:35'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Nombre requerido',
            'nombre.min' => 'Mínimo',
            'nombre.max' => 'Máximo',
            'direccion.required' => 'Direccion requerida',
            'direccion.min' => 'Mínimo',
            'direccion.max' => 'Máximo'
        ];
    }
}
