<?php

namespace App\Http\Requests\Auth\Password;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:8'],
            'password_confirm' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'El usuario es requerido',
            'usuario.string' => 'Usuario inválido',
            'usuario.exists' => 'El usuario no existe',

            'password.required' => 'Debe ingresar una contraseña',
            'password.string' => 'La contraseña debe contener caracteres',
            'password.min' => 'La contraseña debe contener :min caracteres',

            'password_confirm.required' => 'Debe ingresar la contraseña de confirmación',
            'password_confirm.same' => 'Las contraseñas no coinciden'
        ];
    }
}
