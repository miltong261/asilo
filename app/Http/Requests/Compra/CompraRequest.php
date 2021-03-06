<?php

namespace App\Http\Requests\Compra;

use Illuminate\Foundation\Http\FormRequest;

class CompraRequest extends FormRequest
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
            'fecha_compra' => ['required', 'date'],
            'documento' => ['required'],
            'no_documento' => ['required'],
            'arrayData' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'fecha_compra.required' => 'La fecha es obligatoria',
            'fecha_compra.date' => 'Fecha inválida',

            'documento.required' => 'Debe especificar el proveedor',

            'no_documento.required' => 'El número de documento es obligatorio',

            'arrayData.required' => 'No ha seleccionado ningún produto'
        ];
    }
}
