<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $days = ['Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado'];

        $arraySalidas = [];
        $arrayEntradas = [];

        if (!$request->ajax()) return redirect('/asilo');

        $anio = date('Y');

        $salidas = DB::table('movimientos')
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select(DB::raw('DAYNAME(movimientos.fecha_registro) as dias'),
        DB::raw('YEAR(movimientos.fecha_registro) as anio'),
        DB::raw('SUM(monto) as monto'))
        ->whereYear('movimientos.fecha_registro', $anio)
        ->where('tipo_movimiento.salida', 1)
        ->groupBy(DB::raw('DAYNAME(movimientos.fecha_registro)'), DB::raw('YEAR(movimientos.fecha_registro)'))
        ->get();

        foreach ($salidas as $salida) {
            $arraySalidas[] = ['dias' => $days[$salida->dias], 'monto' =>  $salida->monto, 'anio' => $salida->anio];
        }

        $entradas = DB::table('movimientos')
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select(DB::raw('DAYNAME(movimientos.fecha_registro) as dias'),
        DB::raw('YEAR(movimientos.fecha_registro) as anio'),
        DB::raw('SUM(monto) as monto'))
        ->whereYear('movimientos.fecha_registro', $anio)
        ->where('tipo_movimiento.entrada', 1)
        ->groupBy(DB::raw('DAYNAME(movimientos.fecha_registro)'), DB::raw('YEAR(movimientos.fecha_registro)'))
        ->get();

        foreach ($entradas as $entrada) {
            $arrayEntradas[] = ['dias' => $days[$entrada->dias], 'monto' =>  $entrada->monto, 'anio' => $entrada->anio];
        }

        $caja = DB::table('caja')
        ->select('saldo')
        ->get();

        return ['salidas' => $arraySalidas, 'entradas' => $arrayEntradas, 'anio' => $anio, 'caja' => $caja];
    }
}
