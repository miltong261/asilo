<?php

namespace App\Http\Requests\Auth\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'usuario' => ['required', 'string', 'exists:users,usuario'],
            'password' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'El usuario es requerido',
            'usuario.string' => 'Usuario inválido',
            'usuario.exists' => 'El usuario no existe',

            'password.required' => 'La contraseña es requerida',
            'password.string' => 'Contraseña inválida'
        ];
    }
}
