<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardAjusteMedicamentoController extends Controller
{
    public function __invoke(Request $request)
    {
        $months = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril',
        'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
        'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];

        $arraySalidas = [];
        $arrayEntradas = [];

        if (!$request->ajax()) return redirect('/asilo');

        $anio = date('Y');

        $salidas = DB::table('ajuste_producto')
        ->join('productos', 'productos.id', '=', 'ajuste_producto.producto_id')
        ->select(DB::raw('MONTHNAME(ajuste_producto.fecha_registro) as mes'),
        DB::raw('YEAR(ajuste_producto.fecha_registro) as anio'),
        DB::raw('SUM(ajuste_producto.cantidad) as cantidad'))
        ->whereYear('ajuste_producto.fecha_registro', $anio)
        ->where('ajuste_producto.salida', 1)
        ->where('productos.asignacion', 0)
        ->groupBy(DB::raw('MONTHNAME(ajuste_producto.fecha_registro)'), DB::raw('YEAR(ajuste_producto.fecha_registro)'))
        ->orderby('mes', 'desc')
        ->get();

        foreach ($salidas as $salida) {
            $arraySalidas[] = ['mes' => $months[$salida->mes], 'cantidad' => $salida->cantidad, 'anio' => $salida->anio];
        }

        $entradas = DB::table('ajuste_producto')
        ->join('productos', 'productos.id', '=', 'ajuste_producto.producto_id')
        ->select(DB::raw('MONTHNAME(ajuste_producto.fecha_registro) as mes'),
        DB::raw('YEAR(ajuste_producto.fecha_registro) as anio'),
        DB::raw('SUM(ajuste_producto.cantidad) as cantidad'))
        ->whereYear('ajuste_producto.fecha_registro', $anio)
        ->where('ajuste_producto.entrada', 1)
        ->where('productos.asignacion', 0)
        ->groupBy(DB::raw('MONTHNAME(ajuste_producto.fecha_registro)'), DB::raw('YEAR(ajuste_producto.fecha_registro)'))
        ->orderby('mes', 'desc')
        ->get();

        foreach ($entradas as $entrada) {
            $arrayEntradas[] = ['mes' => $months[$entrada->mes], 'cantidad' => $entrada->cantidad, 'anio' => $entrada->anio];
        }

        return ['salidas' => $arraySalidas, 'anio' => $anio, 'entradas' => $arrayEntradas];
    }
}
