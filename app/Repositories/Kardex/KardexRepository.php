<?php

namespace App\Repositories\Kardex;

use App\Models\Kardex;
use App\Models\Residente;
use App\User;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\DetalleSalida;
use App\Repositories\BaseRepository;

use Carbon\Carbon;

class KardexRepository extends BaseRepository
{
    public function getModel()
    {
        return new Kardex();
    }

    public function indexKardex()
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

    public function kardexTabla($id)
    {
        $actual = Carbon::now()->toDateString();

        $data = [];

        $kardexs = $this->getModel()
        ->join('users', 'users.id', '=', 'kardex.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('residentes', 'residentes.id', '=', 'kardex.residente_id')
        ->join('productos', 'productos.id', '=', 'kardex.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.id')
        ->select(
            'users.usuario',
            'empleados.nombre as empleado_nombre',
            'empleados.apellido as empleado_apellido',
            'productos.nombre',
            'productos.presentacion',
            'unidad_medida.nombre as nombre_unidad',
            'kardex.fecha_registro',
            'kardex.hora',
            'kardex.observacion',
        )
        ->where('residentes.id', $id)
        ->where('kardex.fecha_registro', $actual)
        ->get();

        foreach ($kardexs as $kardex) {
            $data[] = [
                'usuario' => $kardex->usuario,
                'empleado_nombre' => $kardex->empleado_nombre,
                'empleado_epellido' => $kardex->empleado_apellido,
                'nombre_medicamento' => $kardex->nombre,
                'presentacion_medicamento' => $kardex->presentacion,
                'nombre_unidad' => $kardex->nombre_unidad,
                'fecha_registro' => $kardex->fecha_registro,
                'hora' => Carbon::parse($kardex->hora)->isoFormat('h:mm:ss A'),
                'observacion' => $kardex->observacion
            ];
        }

        if ($data == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registros para la fecha ' . $actual
            ]);
        } else
            return ['kardex' => $data];
    }

    public function kardexTablaFecha($id, $fecha)
    {
        $actual = Carbon::now()->toDateString();

        $data = [];

        $kardexs = $this->getModel()
        ->join('users', 'users.id', '=', 'kardex.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->join('residentes', 'residentes.id', '=', 'kardex.residente_id')
        ->join('productos', 'productos.id', '=', 'kardex.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.id')
        ->select(
            'users.usuario',
            'empleados.nombre as empleado_nombre',
            'empleados.apellido as empleado_apellido',
            'productos.nombre',
            'productos.presentacion',
            'unidad_medida.nombre as nombre_unidad',
            'kardex.fecha_registro',
            'kardex.hora',
            'kardex.observacion',
        )
        ->where('residentes.id', $id)
        ->where('kardex.fecha_registro', $fecha)
        ->get();

        foreach ($kardexs as $kardex) {
            $data[] = [
                'usuario' => $kardex->usuario,
                'empleado_nombre' => $kardex->empleado_nombre,
                'empleado_epellido' => $kardex->empleado_apellido,
                'nombre_medicamento' => $kardex->nombre,
                'presentacion_medicamento' => $kardex->presentacion,
                'nombre_unidad' => $kardex->nombre_unidad,
                'fecha_registro' => $kardex->fecha_registro,
                'hora' => Carbon::parse($kardex->hora)->isoFormat('h:mm:ss A'),
                'observacion' => $kardex->observacion
            ];
        }

        if ($data == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registros para la fecha ' . $actual
            ]);
        } else
            return ['kardex' => $data];
    }

    public function kardexMedicamentos()
    {
        $medicamento = DetalleSalida::join('productos', 'productos.id', '=', 'detalle_salida.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->join('tipo_producto', 'tipo_producto.id', '=', 'productos.tipo_producto_id')
        ->select(
            'productos.id as medicamento_id',
            'productos.nombre as nombre_medicamento',
            'productos.presentacion as presentacion_medicamento',
            'unidad_medida.nombre as nombre_unidad'
        )
        ->where('productos.asignacion', 0)
        ->where('tipo_producto.id', 1)
        ->groupBy('medicamento.id')
        ->get();

        if ($medicamento == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registros para la fecha ' . $fecha
            ]);
        } else
            return ['medicamentos' => $medicamento];
    }
}
