<?php

namespace App\Repositories\User;

use App\User;
use App\Models\Empleado;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return new User();
    }

    public function indexUsuario()
    {
        return $this->getModel()
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->select('users.id',
            'users.primer_login',
            'users.fecha_registro',
            'users.estado',
            'users.usuario',
            'empleados.estado as estado_empleado',
            'empleados.nombre',
            'empleados.apellido'
        )
        ->orderBy('users.id', 'desc')
        ->get();
    }

    public function storeUser(array $request)
    {
        try {
            DB::beginTransaction();
            $empleado = Empleado::findOrFail($request['empleado_id']);

            // return $usuarios;
            if ($this->getModel()->where('empleado_id', '=', $request['empleado_id'])->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El empleado ya cuenta con un usuario'
                ]);
            } else {
                $primer_nombre = explode(' ', $empleado->nombre);
                $generarUsuario = strtolower($primer_nombre[0]) . '-' . $request['codigo'];

                $usuario = $this->getModel();
                $usuario->rol_id = $request['rol_id'];
                $usuario->empleado_id = $request['empleado_id'];
                $usuario->fecha_registro = Carbon::now();
                $usuario->usuario = $generarUsuario;
                $usuario->password = bcrypt('asilo');
                $usuario->save();

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente el usuario del empleado ' . $empleado->nombre .' ' . $empleado->apellido
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function updateUser(array $request, $id)
    {
        try {
            DB::beginTransaction();
            $usuario = $this->getModel()->findOrFail($id);


            if ($usuario) {
                if (($usuario->usuario == $request['usuario']) && ($request['password'] == $request['password_confirm'])) {
                    $usuario->password = bcrypt($request['password']);
                    $usuario->primer_login = 0;
                    $usuario->save();

                    DB::commit();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Cambio de contraseña exitoso'
                    ]);
                } else {
                    DB::rollback();

                    return response()->json([
                        'status' => 'error',
                        'message' => 'Credenciales inválidas'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function estadoUsuario($action, $id)
    {
        $object = $this->getModel()->findOrFail($id);

        if ($action == 'activar') {
            $object->update(['estado' => 1]);
        } elseif ($action == 'desactivar') {
            $object->estado = 0;
            $object->primer_login = 0;
            $object->password = bcrypt('asilo');
            $object->save();
        }

        return $object;
    }

    public function showUser($id)
    {
        $perfil = [];

        $user_perfil = $this->getModel()
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
        ->select(
            'users.id',
            'users.usuario',
            'empleados.fecha_registro',
            'empleados.codigo',
            'areas.nombre as nombre_area',
            'puestos.nombre as nombre_puesto',
            'empleados.fecha_ingreso',
            'empleados.nombre as nombre_empleado',
            'empleados.apellido as apellido_empleado',
            'empleados.telefono',
            'empleados.direccion',
            'empleados.fecha_nacimiento',
            'empleados.dpi'
        )
        ->where('users.id', $id)
        ->get();

        foreach ($user_perfil as $user) {
            $perfil[] = [
                'id' => $user->id,
                'usuario' => $user->usuario,
                'fecha_registro' => $user->fecha_registro,
                'codigo' => $user->codigo,
                'nombre_area' => $user->nombre_area,
                'nombre_puesto' => $user->nombre_puesto,
                'fecha_ingreso' => $user->fecha_ingreso,
                'nombre' => $user->nombre_empleado . ' ' . $user->apellido_empleado,
                'telefono' => $user->telefono,
                'direccion' => $user->direccion,
                'fecha_nacimiento' => $user->fecha_nacimiento,
                'edad' => Carbon::parse($user->fecha_nacimiento)->age,
                'dpi' => $user->dpi
            ];
        }

        return ['user' => $perfil];
    }

    public function change($id, array $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->getModel()->findOrFail($id);

            if (Hash::check($request['password_actual'], $user->password)){
                $user->password = bcrypt($request['password_nueva']);
                $user->save();

                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Su contraseña ha sido cambiada exitosamente'
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Contraseña inválida'
                ]);
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
