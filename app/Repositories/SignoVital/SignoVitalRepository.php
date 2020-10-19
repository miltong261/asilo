<?php

namespace App\Repositories\SignoVital;

use App\Models\Residente;
use App\Models\SignoVital;
use App\User;
use App\Models\Empleado;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class SignoVitalRepository extends BaseRepository
{
    public function getModel()
    {
        return new SignoVital();
    }

    public function indexSignos()
    {
        $pacientes = [];
        $fecha_actual = Carbon::now()->toDateString();

        $residentes = Residente::select(
            'id', 'codigo', 'nombre', 'apellido', 'fecha_nacimiento'
        )
        ->get();

        foreach ($residentes as $residente) {
            $nacimiento = Carbon::parse($residente->fecha_nacimiento);
            $pacientes[] = ['id' => $residente->id,
                'codigo' => $residente->codigo,
                'nombre' => $residente->nombre,
                'apellido' => $residente->apellido,
                'edad' => Carbon::parse($residente->fecha_nacimiento)->age
            ];
        }

        $id = \Auth::user()->id;
        $user = User::where('users.id', '=', $id)
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->select('users.usuario', 'empleados.nombre', 'empleados.apellido')->get();

        return response()->json(['pacientes' => $pacientes, 'usuario' => $user]);
    }

    public function signosTabla($id)
    {
        $actual = Carbon::now()->toDateString();

        $data = [];

        $signos = $this->getModel()
        ->join('users', 'users.id', '=', 'signos_vitales.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('residentes', 'residentes.id', '=', 'signos_vitales.residente_id')
        ->select(
            'users.usuario',
            'empleados.nombre as empleado_nombre',
            'empleados.apellido as empleado_apellido',
            'signos_vitales.fecha_registro',
            'signos_vitales.hora_registro',
            'signos_vitales.respiraciones',
            'signos_vitales.presion',
            'signos_vitales.pulso',
            'signos_vitales.peso',
            'signos_vitales.temperatura',
            'signos_vitales.observacion'
        )
        ->where('residentes.id', $id)
        ->where('signos_vitales.fecha_registro', $actual)
        ->get();

        foreach ($signos as $signo) {
            $data[] = [
                'usuario' => $signo->usuario,
                'empleado_nombre' => $signo->empleado_nombre,
                'empleado_epellido' => $signo->empleado_apellido,
                'fecha_registro' => $signo->fecha_registro,
                'hora_registro' => Carbon::parse($signo->hora_registro)->isoFormat('h:mm:ss A'),
                'respiraciones' => $signo->respiraciones,
                'presion' => $signo->presion,
                'pulso' => $signo->pulso,
                'peso' => $signo->peso,
                'temperatura' => $signo->temperatura,
                'observacion' => $signo->observacion
            ];
        }

        if ($data == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registro de signos para la fecha ' . $actual
            ]);
        } else
            return ['notas' => $data];
    }

    public function signosTablaFecha($id, $fecha)
    {
        $data = [];

        $signos = $this->getModel()
        ->join('users', 'users.id', '=', 'signos_vitales.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('residentes', 'residentes.id', '=', 'signos_vitales.residente_id')
        ->select(
            'users.usuario',
            'empleados.nombre as empleado_nombre',
            'empleados.apellido as empleado_apellido',
            'signos_vitales.fecha_registro',
            'signos_vitales.hora_registro',
            'signos_vitales.respiraciones',
            'signos_vitales.presion',
            'signos_vitales.pulso',
            'signos_vitales.peso',
            'signos_vitales.temperatura',
            'signos_vitales.observacion'
        )
        ->where('residentes.id', $id)
        ->where('signos_vitales.fecha_registro', $fecha)
        ->get();

        foreach ($signos as $signo) {
            $data[] = [
                'usuario' => $signo->usuario,
                'empleado_nombre' => $signo->empleado_nombre,
                'empleado_epellido' => $signo->empleado_apellido,
                'fecha_registro' => $signo->fecha_registro,
                'hora_registro' => Carbon::parse($signo->hora_registro)->isoFormat('h:mm:ss A'),
                'respiraciones' => $signo->respiraciones,
                'presion' => $signo->presion,
                'pulso' => $signo->pulso,
                'peso' => $signo->peso,
                'temperatura' => $signo->temperatura,
                'observacion' => $signo->observacion
            ];
        }

        if ($data == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registro de signos para la fecha ' . $fecha
            ]);
        } else
            return ['notas' => $data];
    }

}
