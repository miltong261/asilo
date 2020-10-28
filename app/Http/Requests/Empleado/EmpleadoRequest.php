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
            'area_id' => ['required'],
            'puesto_id' => ['required'],
            'nombre' => ['required', 'string', 'min:5', 'max:35'],
            'apellido' => ['required', 'string', 'min:5', 'max:35'],
            'fecha_ingreso' => ['required', 'date'],
            'fecha_nacimiento' => ['required', 'date'],
            'dpi' => ['required', 'unique:empleados,dpi,' . $this->id, 'digits:13'],
            'telefono' => ['required', 'digits:8'],
            'direccion' => ['required', 'min:5', 'max:70']
        ];
    }

    public function messages()
    {
        return [
            'area_id.required' => 'El área es obligatorio',

            'puesto_id.required' => 'El puesto es obligatorio',

            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'Solo se permiten caracteres',
            'nombre.min' => 'El nombre debe contener como mínimo :min caracteres',
            'nombre.max' => 'El nombre debe contener como máximo :max caracteres',

            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria',
            'fecha_ingreso.date' => 'Solo se permite fecha',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'Solo se permite fecha',

            'dpi.required' => 'El DPI es obligatorio',
            'dpi.digits' => 'El DPI contiene 13 dígitos',
            'dpi.unique' => 'Este número de DPI ya existe',

            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.digits' => 'El número contiene 8 dígitos',

            'direccion.required' => 'La dirección es obligatoria',
            'direccion.min' => 'La dirección debe contener como mínimo :min caracteres',
            'direccion.max' => 'La dirección debe contener como máximo :max caracteres'
        ];
    }
}
