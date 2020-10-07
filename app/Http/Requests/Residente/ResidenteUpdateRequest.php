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
            'fecha_nacimiento' => ['required', 'date'],
            'motivo' => ['required'],
            'estado' => ['required'],
            'historial' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'Solo se permiten :max caracteres',

            'apellido.required' => 'El apellido es obligatorio',
            'apellido.max' => 'Solo se permiten :max caracteres',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.date' => 'Fecha inválida',

            'motivo.required' => 'Debe especificar el motivo de la llegada',

            'estado.required' => 'Debe especificar el estado actual de la persona',

            'historial.required' => 'Debe especificar el cuadro clínico en el que llega la persona',
        ];
    }
}
