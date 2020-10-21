<?php

namespace App\Http\Requests\TipoMovimiento;

use Illuminate\Foundation\Http\FormRequest;

class TipoMovimientoRequest extends FormRequest
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
            'nombre' => ['required', 'max:35', 'unique:tipo_movimiento,nombre,' .$this->id],
            'entrada' => 'nullable|boolean',
            'salida' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre debe contener como máximo :max caracteres',
            'nombre.unique' => 'El tipo de movimiento ya esta registrado'
        ];
    }
}
