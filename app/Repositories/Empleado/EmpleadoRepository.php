<?php
namespace App\Repositories\Empleado;

use App\Models\Puesto;
use App\Models\Empleado;
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
}
