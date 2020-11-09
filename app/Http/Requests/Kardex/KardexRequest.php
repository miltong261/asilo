<?php

namespace App\Http\Requests\Kardex;

use Illuminate\Foundation\Http\FormRequest;

class KardexRequest extends FormRequest
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
            'cantidad' => ['required', 'numeric', 'between:1,99999.99'],
            'observacion' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'cantidad.required' => 'La cantidad es obligatoria',
            'cantidad.numeric' => 'Solo se permiten números',
            'cantidad.between' => 'Cantidad inválida',
            'observacion.required' => 'Campo obligatorio'
        ];
    }
}
