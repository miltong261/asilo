<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardMedicamentosController extends Controller
{
    public function __invoke(Request $request)
    {
        $months = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril',
        'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
        'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];

        $arraySalidas = [];
        $arrayDonaciones = [];

        if (!$request->ajax()) return redirect('/asilo');

        $anio = date('Y');

        $salidas = DB::table('detalle_salida as d_salida')
        ->join('salidas', 'salidas.id', '=', 'd_salida.salida_id')
        ->join('productos', 'productos.id', '=', 'd_salida.producto_id')
        ->select(DB::raw('MONTHNAME(salidas.fecha_salida) as mes'),
        DB::raw('YEAR(salidas.fecha_salida) as anio'),
        DB::raw('SUM(d_salida.cantidad) as cantidad'))
        ->whereYear('salidas.fecha_salida', $anio)
        ->where('productos.asignacion', 0)
        ->groupBy(DB::raw('MONTHNAME(salidas.fecha_salida)'), DB::raw('YEAR(salidas.fecha_salida)'))
        ->orderby('mes', 'desc')
        ->get();

        foreach ($salidas as $salida) {
            $arraySalidas[] = ['mes' => $months[$salida->mes], 'cantidad' => $salida->cantidad, 'anio' => $salida->anio];
        }

        $donaciones = DB::table('detalle_donacion as d_donacion')
        ->join('donaciones', 'donaciones.id', '=', 'd_donacion.donacion_id')
        ->join('productos', 'productos.id', '=', 'd_donacion.producto_id')
        ->select(DB::raw('MONTHNAME(donaciones.fecha_donacion) as mes'),
        DB::raw('YEAR(donaciones.fecha_donacion) as anio'),
        DB::raw('SUM(d_donacion.cantidad) as cantidad'))
        ->whereYear('donaciones.fecha_donacion', $anio)
        ->where('productos.asignacion', 0)
        ->groupBy(DB::raw('MONTHNAME(donaciones.fecha_donacion)'), DB::raw('YEAR(donaciones.fecha_donacion)'))
        ->orderby('mes', 'desc')
        ->get();

        foreach ($donaciones as $donacion) {
            $arrayDonaciones[] = ['mes' => $months[$donacion->mes], 'cantidad' => $donacion->cantidad, 'anio' => $donacion->anio];
        }

        return ['salidas' => $arraySalidas, 'anio' => $anio, 'donaciones' => $arrayDonaciones];
    }
}
