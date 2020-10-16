<?php
namespace App\Repositories\Empleado;

use App\Models\Puesto;
use App\Models\Empleado;
use App\User;
use App\Repositories\BaseRepository;

class EmpleadoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Empleado();
    }

    public function indexEmpleado()
    {
        return $this->getModel()
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
        ->select('empleados.*', 'puestos.nombre as puesto_nombre', 'areas.nombre as area_nombre')
        ->get();
    }

    public function comboboxEmpleado() {
        return $this->getModel()
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->select('empleados.id', 'empleados.nombre as nombre_empleado', 'empleados.apellido as apellido_empleado', 'areas.nombre as nombre_area')
        ->where('empleados.estado', 1)
        ->orderBy('empleados.nombre', 'asc')
        ->get();
    }

    public function comboboxUsuario() {
        return $this->getModel()
        ->select('id', 'nombre', 'apellido')
        ->where('estado', 1)
        ->orderBy('nombre', 'asc')
        ->get();
    }

    /** Método para cambiar de estado */
    public function estadoEmpleado($action, $id)
    {
        $object = $this->getModel()->findOrFail($id);
        $user = User::where('empleado_id', $id);

        if ($action == 'activar') {
            $object->estado = 1;
            $user->update(['estado' => 1, 'password' => bcrypt($user->usuario)]);
        } elseif ($action == 'desactivar') {
            $object->estado = 0;
            $user->update(['estado' => 0, 'primer_login' => 0]);
        }

        return $object->save();
    }
}
