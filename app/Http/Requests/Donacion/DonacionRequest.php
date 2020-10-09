<?php

namespace App\Http\Requests\Donacion;

use Illuminate\Foundation\Http\FormRequest;

class DonacionRequest extends FormRequest
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
            'fecha_donacion' => ['required', 'date'],

            'arrayData' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'fecha_donacion.required' => 'La fecha es obligatoria',
            'fecha_donacion.date' => 'Fecha inválida',

            'arrayData.required' => 'No ha seleccionado ningún produto'
        ];
    }
}
