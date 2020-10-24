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
        ->orderBy('empleados.codigo', 'desc')
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
        ->join('puestos', 'puestos.id', '=', 'empleados.puesto_id')
        ->select(
            'empleados.id',
            'empleados.nombre',
            'empleados.apellido',
            'puestos.nombre as nombre_puesto'
        )
        ->where('empleados.estado', 1)
        ->where('empleados.puesto_id', '=', 1)
        ->orWhere('empleados.puesto_id', '=', 2)
        ->orWhere('empleados.puesto_id', '=', 3)
        ->orderBy('empleados.nombre', 'asc')
        ->get();
    }

    /** Método para cambiar de estado */
    public function estadoEmpleado($action, $id)
    {
        $object = $this->getModel()->findOrFail($id);
        $user = User::where('empleado_id', $id);

        if ($user) {
            if ($action == 'activar') {
                $object->estado = 1;
            } elseif ($action == 'desactivar') {
                $object->estado = 0;
                $user->update(['estado' => 0, 'primer_login' => 0, 'password' => bcrypt('asilo')]);
            }
        } else {
            if ($action == 'activar') {
                $object->estado = 1;
            } elseif ($action == 'desactivar') {
                $object->estado = 0;
            }
        }

        return $object->save();
    }
}
