<?php

namespace App\Repositories\Producto;

use App\Models\Inventario;
use App\Models\UnidadMedida;
use App\Models\TipoProducto;
use App\Models\Producto;

use App\Models\AjusteProducto;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Salida;
use App\Models\DetalleSalida;
use App\Models\Donacion;
use App\Models\DetalleDonacion;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Producto();
    }

    public function indexProducto($type)
    {
        $asignacion;

        if ($type == 'producto')
            $asignacion = 1;
        elseif ($type == 'medicamento')
            $asignacion = 0;

        return $this->getModel()
            ->join('users', 'users.id', '=', 'productos.user_id')
            ->join('inventario', 'inventario.producto_id', '=', 'productos.id')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
            ->join('tipo_producto', 'tipo_producto.id', '=', 'productos.tipo_producto_id')
            ->select('productos.*',
                'users.usuario as nombre_usuario',
                'users.rol_id',
                'inventario.existencia',
                'unidad_medida.nombre as unidad_nombre',
                'tipo_producto.nombre as categoria_nombre'
            )
            ->where('productos.asignacion', $asignacion)
            ->get();
    }

    /* Método para guardar producto y medicamento */
    public function storeProduct(array $request)
    {
        $inventario = new Inventario();

        $producto = $this->getModel()->create($request);
        $inventario->producto_id = $producto->id;
        $inventario->save();

        return 'exitoso';
    }

    /* Método para generar código de producto y medicamento */
    public function generateCodeProduct($type)
    {
        if ($type == 'producto') {
            $count = $this->getModel()
            ->where('asignacion', '1')
            ->count();
        } elseif ($type == 'medicamento') {
            $count = $this->getModel()
            ->where('asignacion', '0')
            ->count();
        }

        if ($count >= 1000 && $count < 10000)
            return $count+=1;
        elseif ($count >= 100 && $count < 1000)
            return '0' .$count+=1;
        elseif ($count >= 9 && $count < 100)
            return '00' .$count+=1;
        else
            return '000' .$count+=1;
    }

    public function productoPorVencer($type)
    {
        $asignacion;

        if ($type == 'producto')
            $asignacion = 1;
        elseif ($type == 'medicamento')
            $asignacion = 0;

        $fecha_actual = Carbon::now()->toDateString();
        $fecha_final = Carbon::now()->addDays(30)->toDateString();

        return $this->getModel()
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->join('inventario', 'inventario.producto_id', '=', 'productos.id')
        ->select(
            'productos.id',
            'productos.codigo',
            'productos.nombre',
            'productos.presentacion',
            'unidad_medida.nombre as nombre_unidad',
            'inventario.existencia',
            'productos.fecha_vencimiento'
        )
        ->where('asignacion', $asignacion)
        ->where('inventario.existencia', '>', 0)
        ->whereBetween('productos.fecha_vencimiento', [$fecha_actual, $fecha_final])
        ->get();
    }

    public function productoVencido($type)
    {
        $asignacion;

        if ($type == 'producto')
            $asignacion = 1;
        elseif ($type == 'medicamento')
            $asignacion = 0;

        $fecha_actual = Carbon::now()->toDateString();

        return $this->getModel()
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->join('inventario', 'inventario.producto_id', '=', 'productos.id')
        ->select(
            'productos.id',
            'productos.codigo',
            'productos.nombre',
            'productos.presentacion',
            'unidad_medida.nombre as nombre_unidad',
            'inventario.existencia',
            'productos.fecha_vencimiento'
        )
        ->where('asignacion', $asignacion)
        ->where('inventario.existencia', '>', 0)
        ->where('productos.fecha_vencimiento', '<', $fecha_actual)
        ->get();
    }

    public function pdfInventario($type, $month)
    {
        if ($type == 'producto')
            $asignacion = 0;
        elseif ($type == 'medicamento')
            $asignacion = 1;

        $anio = date('Y');

        if (date('L', strtotime("$anio-02-01"))) {
            $months = [
                'Enero' => [
                    $anio . '-01-01',
                    $anio . '-01-31'
                ],
                'Febrero' => [
                    $anio . '-02-01',
                    $anio . '-02-29'
                ],
                'Marzo' => [
                    $anio . '-03-01',
                    $anio . '-03-31'
                ],
                'Abril' => [
                    $anio . '-04-01',
                    $anio . '-04-30'
                ],
                'Mayo' => [
                    $anio . '-05-01',
                    $anio . '-05-31'
                ],
                'Junio' => [
                    $anio . '-06-01',
                    $anio . '-06-30'
                ],
                'Julio' => [
                    $anio . '-07-01',
                    $anio . '-07-31'
                ],
                'Agosto' => [
                    $anio . '-08-01',
                    $anio . '-08-31'
                ],
                'Septiembre' => [
                    $anio . '-09-01',
                    $anio . '-09-30'
                ],
                'Octubre' => [
                    $anio . '-10-01',
                    $anio . '-10-31'
                ],
                'Noviembre' => [
                    $anio . '-11-01',
                    $anio . '-11-30'
                ],
                'Diciembre' => [
                    $anio . '-12-01',
                    $anio . '-12-31'
                ]
            ];
        } else {
            $months = [
                'Enero' => [
                    $anio . '-01-01',
                    $anio . '-01-31'
                ],
                'Febrero' => [
                    $anio . '-02-01',
                    $anio . '-02-28'
                ],
                'Marzo' => [
                    $anio . '-03-01',
                    $anio . '-03-31'
                ],
                'Abril' => [
                    $anio . '-04-01',
                    $anio . '-04-30'
                ],
                'Mayo' => [
                    $anio . '-05-01',
                    $anio . '-05-31'
                ],
                'Junio' => [
                    $anio . '-06-01',
                    $anio . '-06-30'
                ],
                'Julio' => [
                    $anio . '-07-01',
                    $anio . '-07-31'
                ],
                'Agosto' => [
                    $anio . '-08-01',
                    $anio . '-08-31'
                ],
                'Septiembre' => [
                    $anio . '-09-01',
                    $anio . '-09-30'
                ],
                'Octubre' => [
                    $anio . '-10-01',
                    $anio . '-10-31'
                ],
                'Noviembre' => [
                    $anio . '-11-01',
                    $anio . '-11-30'
                ],
                'Diciembre' => [
                    $anio . '-12-01',
                    $anio . '-12-31'
                ]
            ];
        }

        $data = ['inicio' => $months[$month][0], 'fin' => $months[$month][1]];
    }
}
