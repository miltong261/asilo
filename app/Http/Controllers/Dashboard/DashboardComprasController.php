<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardComprasController extends Controller
{
    public function __invoke(Request $request)
    {
        $months = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril',
        'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
        'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];

        $arrayArticulos = [];
        $arrayMedicamentos = [];

        if (!$request->ajax()) return redirect('/asilo');

        $anio = date('Y');

        $compras_articulo = DB::table('detalle_compra as d_compra')
        ->join('compras', 'compras.id', '=', 'd_compra.compra_id')
        ->join('productos', 'productos.id', '=', 'd_compra.producto_id')
        ->select(DB::raw('MONTHNAME(compras.fecha_compra) as mes'),
        DB::raw('YEAR(compras.fecha_compra) as anio'),
        DB::raw('SUM(d_compra.cantidad) as cantidad'))
        ->whereYear('compras.fecha_compra', $anio)
        ->where('productos.asignacion', 1)
        ->groupBy(DB::raw('MONTHNAME(compras.fecha_compra)'), DB::raw('YEAR(compras.fecha_compra)'))
        ->orderby('mes', 'desc')
        ->get();

        foreach ($compras_articulo as $articulo) {
            $arrayArticulos[] = ['mes' => $months[$articulo->mes], 'cantidad' => $articulo->cantidad, 'anio' => $articulo->anio];
        }

        $compras_medicamento = DB::table('detalle_compra as d_compra')
        ->join('compras', 'compras.id', '=', 'd_compra.compra_id')
        ->join('productos', 'productos.id', '=', 'd_compra.producto_id')
        ->select(DB::raw('MONTHNAME(compras.fecha_compra) as mes'),
        DB::raw('YEAR(compras.fecha_compra) as anio'),
        DB::raw('SUM(d_compra.cantidad) as cantidad'))
        ->whereYear('compras.fecha_compra', $anio)
        ->where('productos.asignacion', 0)
        ->groupBy(DB::raw('MONTHNAME(compras.fecha_compra)'), DB::raw('YEAR(compras.fecha_compra)'))
        ->orderby('mes', 'desc')
        ->get();

        foreach ($compras_medicamento as $medicamento) {
            $arrayMedicamentos[] = ['mes' => $months[$medicamento->mes], 'cantidad' => $medicamento->cantidad, 'anio' => $medicamento->anio];
        }

        return ['compras_articulo' => $arrayArticulos, 'anio' => $anio, 'compras_medicamento' => $arrayMedicamentos];
    }
}
