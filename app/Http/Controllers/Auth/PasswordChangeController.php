<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Password\ChangeRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class PasswordChangeController extends Controller
{
    public function change()
    {
        return view('auth.passwords.change');
    }

    public function newPassword(ChangeRequest $request)
    {
        try {
            DB::beginTransaction();
            $usuario = User::where('usuario', $request->usuario);

            if ($usuario) {
                $usuario->update(['password' => bcrypt($request->password), 'primer_login' => 1]);
                DB::commit();
                return redirect()->route('login')->with([
                    'status' => 'Su contraseña ha sido cambiada exitosamente'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
}
