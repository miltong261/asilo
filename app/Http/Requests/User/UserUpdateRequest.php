<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'usuario' => ['required', 'exists:users,usuario'],
            'password' => ['required'],
            'password_confirm' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'El usuario es obligatorio',
            'usuario.exists' => 'El usuario no existe',

            'password.required' => 'La constraseña es obligatoria',

            'password_confirm.required' => 'La confirmación es obligatoria',
            'password_confirm.same' => 'Las contraseñas no coinciden'
        ];
    }
}
