<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // use AuthenticatesUsers;
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $verify = $request->only('usuario', 'password') + ['estado' => 1] + ['primer_login' => 0];
        $credentials = $request->only('usuario', 'password') + ['estado' => 1];

        if (Auth::attempt($verify)) {
            return redirect()->route('change_password')
            ->with([
                'status' => 'Para su primer incicio de sesión, cambie su contraseña'
            ]);
        } elseif (Auth::attempt($credentials)) {
            return redirect()->route('asilo');
        }

        return back()
        ->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(request(['usuario']));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
