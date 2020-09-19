<?php

namespace App\Http\Requests\Empleado;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
            'puesto_id' => 'required',
            'nombre' => ['required', 'string', 'min:5', 'max:35'],
            'apellido' => ['required', 'string', 'min:5', 'max:35'],
            'fecha_nacimiento' => ['required', 'date'],
            'dpi' => ['required', 'unique:empleados'],
            'telefono' => ['required'],
            'direccion' => ['required', 'min:5', 'max:35']
        ];
    }

    public function messages()
    {
        return [
            'puesto_id.required' => 'El puesto es obligatorio',

            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'Solo se permiten caracteres',
            'nombre.min' => 'El nombre debe contener como mínimo :min caracteres',
            'nombre.max' => 'El nombre debe contener como máximo :max caracteres',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'Solo se permite fecha',

            'dpi.required' => 'El DPI es obligatorio',
            // 'dpi.digits' => 'El DPI contiene 13 dígitos',
            'dpi.unique' => 'Este número de DPI ya existe',

            'telefono.required' => 'El número de teléfono es obligatorio',
            // 'telefono.digits' => 'El número contiene 8 dígitos',

            'direccion.required' => 'La dirección es obligatoria',
            'direccion.min' => 'La dirección debe contener como mínimo :min caracteres',
            'direccion.max' => 'La dirección debe contener como máximo :max caracteres'
        ];
    }
}
