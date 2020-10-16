<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $anio = date('Y');

        $salidas = DB::table('movimientos')
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select(DB::raw('DAYNAME(movimientos.fecha_registro) as dias'),
        DB::raw('YEAR(movimientos.fecha_registro) as anio'),
        DB::raw('monto'))
        ->whereYear('movimientos.fecha_registro', $anio)
        ->where('tipo_movimiento.salida', 1)
        ->get();


        $entradas = DB::table('movimientos')
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select(DB::raw('DAYNAME(movimientos.fecha_registro) as dias'),
        DB::raw('YEAR(movimientos.fecha_registro) as anio'),
        DB::raw('monto'))
        ->whereYear('movimientos.fecha_registro', $anio)
        ->where('tipo_movimiento.entrada', 1)
        ->get();

        $caja = DB::table('caja')
        ->select('saldo')
        ->get();

        return ['salidas' => $salidas, 'entradas' => $entradas, 'anio' => $anio, 'caja' => $caja];
    }
}
