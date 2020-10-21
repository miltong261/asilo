<?php

namespace App\Http\Requests\Residente;

use Illuminate\Foundation\Http\FormRequest;

class ResidenteRequest extends FormRequest
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
            'municipio_origen' => ['required'],
            'municipio_dpi' => ['required'],
            'nombre' => ['required', 'max:35'],
            'apellido' => ['required', 'max:35'],
            'fecha_nacimiento' => ['required', 'date'],
            'dpi' => ['required', 'digits:13', 'unique:residentes,dpi'],
            'telefono_familia' => ['nullable', 'digits:8'],
            'telefono_persona_referida' => ['nullable', 'digits:8'],
            'motivo' => ['required'],
            'estado' => ['required'],
            'historial' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'municipio_origen.required' => 'Debe seleccionar lugar de origen',

            'municipio_dpi.required' => 'Debe seleccionar el lugar donde se tramito el DPI',

            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'Solo se permiten :max caracteres',

            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'Solo se permiten :max caracteres',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'Fecha inválida',

            'dpi.required' => 'El DPI es obligatorio',
            'dpi.digits' => 'El DPI contiene 13 dígitos',
            'dpi.unique' => 'El DPI ya existe',

            'telefono_familia.digits' => 'El número contiene 8 dígitos',
            'telefono_persona_referida' => 'El número contiene 8 dígitos',

            'motivo.required' => 'Debe especificar el motivo de la llegada',

            'estado.required' => 'Debe especificar el estado actual de la persona',

            'historial.required' => 'Debe especificar el cuadro clínico en el que llega la persona',
        ];
    }
}
