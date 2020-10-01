<?php

namespace App\Http\Requests\AjusteProducto;

use Illuminate\Foundation\Http\FormRequest;

class AjusteProductoRequest extends FormRequest
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
            'producto_id' => ['required'],
            'cantidad' => ['required', 'integer', 'between:1,99999'],
            'observacion' => ['required', 'max:70']
        ];
    }

    public function messages()
    {
        return [
            'producto_id.required' => 'No ha seleccionado producto',

            'cantidad.required' => 'La cantidad es obligatoria',
            'cantidad.integer' => 'La cantidad debe ser un número entero',
            'cantidad.between' => 'Número inválido',

            'observacion.required' => 'Para realizar un ajuste debe especificar el motivo',
            'observacion.max' => 'Solo se permiten :max caracteres'
        ];
    }
}
