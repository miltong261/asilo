<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
            'password_actual' => ['required'],
            'password_nueva' => ['required', 'string', 'min:8'],
            'password_confirm' => ['required', 'same:password_nueva']
        ];
    }

    public function messages()
    {
        return [
            'password_actual.required' => 'Campo obligatorio',

            'password_nueva.required' => 'Campo obligatorio',
            'password_nueva.min' => 'La contraseña debe contener :min caracteres',

            'password_confirm.required' => 'Campo obligatorio',
            'password_confirm.same' => 'Las contraseñas no coinciden'
        ];
    }
}
