<?php

namespace App\Repositories\Nota;

use App\Models\Residente;
use App\Models\Nota;
use App\User;
use App\Models\Empleado;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class NotaRepository extends BaseRepository
{
    public function getModel()
    {
        return new Nota();
    }

    public function indexNotas()
    {
        $pacientes = [];
        $fecha_actual = Carbon::now()->toDateString();

        $residentes = Residente::select(
            'id', 'codigo', 'nombre', 'apellido', 'fecha_nacimiento', 'activo', 'defuncion'
        )
        ->get();

        foreach ($residentes as $residente) {
            $nacimiento = Carbon::parse($residente->fecha_nacimiento);
            $pacientes[] = ['id' => $residente->id,
                'codigo' => $residente->codigo,
                'nombre' => $residente->nombre,
                'apellido' => $residente->apellido,
                'edad' => Carbon::parse($residente->fecha_nacimiento)->age,
                'activo' => $residente->activo,
                'defuncion' => $residente->defuncion
            ];
        }

        $id = \Auth::user()->id;
        $user = User::where('users.id', '=', $id)
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->select('users.usuario', 'users.rol_id', 'empleados.nombre', 'empleados.apellido')->get();

        return response()->json(['pacientes' => $pacientes, 'usuario' => $user]);
    }

    public function notasTabla($id)
    {
        $actual = Carbon::now()->toDateString();

        $data = [];

        $notas = $this->getModel()
        ->join('users', 'users.id', '=', 'notas.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('residentes', 'residentes.id', '=', 'notas.residente_id')
        ->select(
            'users.usuario',
            'empleados.nombre as empleado_nombre',
            'empleados.apellido as empleado_apellido',
            'notas.fecha_registro',
            'notas.hora',
            'notas.nota'
        )
        ->where('residentes.id', $id)
        ->where('notas.fecha_registro', $actual)
        ->get();

        foreach ($notas as $nota) {
            $data[] = [
                'usuario' => $nota->usuario,
                'empleado_nombre' => $nota->empleado_nombre,
                'empleado_epellido' => $nota->empleado_apellido,
                'fecha_registro' => $nota->fecha_registro,
                'hora' => Carbon::parse($nota->hora)->isoFormat('h:mm:ss A'),
                'nota' => $nota->nota
            ];
        }

        if ($data == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registro de notas para la fecha ' . $actual
            ]);
        } else
            return ['notas' => $data];
    }

    public function notasTablaFecha($id, $fecha)
    {
        $data = [];

        $notas = $this->getModel()
        ->join('users', 'users.id', '=', 'notas.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('residentes', 'residentes.id', '=', 'notas.residente_id')
        ->select(
            'users.usuario',
            'empleados.nombre as empleado_nombre',
            'empleados.apellido as empleado_apellido',
            'notas.fecha_registro',
            'notas.hora',
            'notas.nota'
        )
        ->where('residentes.id', $id)
        ->where('notas.fecha_registro', $fecha)
        ->get();

        foreach ($notas as $nota) {
            $data[] = [
                'usuario' => $nota->usuario,
                'empleado_nombre' => $nota->empleado_nombre,
                'empleado_epellido' => $nota->empleado_apellido,
                'fecha_registro' => $nota->fecha_registro,
                'hora' => Carbon::parse($nota->hora)->isoFormat('h:mm:ss A'),
                'nota' => $nota->nota
            ];
        }

        if ($data == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registro de notas para la fecha ' . $fecha
            ]);
        } else
            return ['notas' => $data];
    }
}
