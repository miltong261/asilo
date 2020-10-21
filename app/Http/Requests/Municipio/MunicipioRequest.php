<?php

namespace App\Http\Requests\Municipio;

use Illuminate\Foundation\Http\FormRequest;

class MunicipioRequest extends FormRequest
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
            'departamento_id' => ['required'],
            'nombre' => ['required', 'unique:municipios,nombre,' . $this->id]
        ];
    }

    public function messages()
    {
        return [
            'departamento_id.required' => 'Debe de seleccionar departamento',

            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'El municipio ya existe'
        ];
    }
}
