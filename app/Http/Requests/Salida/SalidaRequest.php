<?php

namespace App\Http\Requests\Salida;

use Illuminate\Foundation\Http\FormRequest;

class SalidaRequest extends FormRequest
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
            'fecha_salida' => ['required', 'date'],
            'empleado_id' => ['required'],
            'nota_salida' => ['nullable'],
            'arrayData' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'fecha_salida.required' => 'La fecha es obligatoria',
            'fecha_salida.date' => 'Fecha inválida',

            'empleado_id.required' => 'Debe seleccionar al empleado que solicita los productos',

            'arrayData.required' => 'No ha seleccionado ningún produto'
        ];
    }
}
