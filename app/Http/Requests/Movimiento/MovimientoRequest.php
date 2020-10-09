<?php

namespace App\Http\Requests\Movimiento;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoRequest extends FormRequest
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
            'tipo_movimiento_id' => ['required'],
            'monto' => ['required', 'numeric', 'between:1,99999.99'],
            'observacion' => ['required', 'max:70']
        ];
    }

    public function messages()
    {
        return [
            'tipo_movimiento_id.required' => 'El tipo de movimiento es obligatorio',

            'monto.required' => 'El monto es obligatorio',
            'monto.numeric' => 'Solo se aceptan números',
            'monto.between' => 'El monto es incorrecto',

            'observacion.required' => 'La observación no puede quedar vacía',
            'observacion.max' => 'Solo se permiten :max caracteres'
        ];
    }
}
