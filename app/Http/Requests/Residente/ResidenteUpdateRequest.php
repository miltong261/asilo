<?php

namespace App\Http\Requests\Residente;

use Illuminate\Foundation\Http\FormRequest;

class ResidenteUpdateRequest extends FormRequest
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
            'apellido' => ['required', 'max:35'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'dpi' => ['nullable', 'digits:13', 'unique:residentes,dpi'],
            'telefono_familia' => ['nullable', 'digits:8'],
            'telefono_persona_referida' => ['nullable', 'digits:8'],
            'motivo' => ['required'],
            'estado_fisico' => ['required'],
            'estado_medico' => ['required'],
            'estado_psicologico' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'Solo se permiten :max caracteres',

            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'Solo se permiten :max caracteres',

            'fecha_nacimiento.date' => 'Fecha inválida',

            'dpi.digits' => 'El DPI contiene 13 dígitos',
            'dpi.unique' => 'El DPI ya existe',

            'telefono_familia.digits' => 'El número contiene 8 dígitos',

            'telefono_persona_referida' => 'El número contiene 8 dígitos',

            'motivo.required' => 'Debe especificar el motivo de la llegada',

            'estado_fisico.required' => 'Debe especificar el estado actual de la persona',
            'estado_medico.required' => 'Debe especificar el estado actual de la persona',
            'estado_psicologico.required' => 'Debe especificar el estado actual de la persona',
        ];
    }
}
