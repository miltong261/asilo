<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'unidad_medida_id' => ['required'],
            'tipo_producto_id' => ['required'],
            'nombre' => ['required', 'max:35'],
            'fecha_vencimiento' => ['nullable', 'date']
        ];
    }

    public function messages()
    {
        return [
            'unidad_medida_id.required' => 'La unidad de medida es obligatoria',

            'tipo_producto_id.required' => 'La categoría es obligatoria',

            'nombre.required' => 'El nombre del producto es obligatorio',
            'nombre.max' => 'El nombre debe contener como máximo :max caracteres',
            'fecha_vencimiento.date' => 'Fecha invalida'
        ];
    }
}
