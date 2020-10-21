<?php

namespace App\Repositories\User;

use App\User;
use App\Models\Empleado;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;
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
        ->orderBy('users.id', 'asc')
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
                    $usuario->update(['password' => bcrypt($request['password'])]);

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
}
