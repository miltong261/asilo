<?php

namespace App\Repositories\Salida;

use App\Models\Salida;
use App\Models\DetalleSalida;
use App\Models\Inventario;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;

class SalidaRepository extends BaseRepository
{
    public function getModel()
    {
        return new Salida();
    }

    public function indexSalida()
    {
        return $this->getModel()
        ->join('empleados', 'empleados.id', '=', 'salidas.empleado_id')
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->select(
            'salidas.*',
            'empleados.nombre as nombre_empleado',
            'empleados.apellido as apellido_empleado',
            'areas.nombre as nombre_area'
        )
        ->get();
    }

    public function storeSalida(array $request, array $data )
    {
        try {
            DB::beginTransaction();

            $encabezado = $this->getModel()->create($request);

            foreach ($data as $key => $detalle) {
                $inventario = Inventario::findOrFail($detalle['producto_id']);

                if ($inventario) {
                    try{
                        if ($inventario->existencia >= $detalle['cantidad']) {
                            $inventario->existencia -= $detalle['cantidad'];
                            $inventario->update(['existencia' => $inventario->existencia]);
                            $detalle_salida = new DetalleSalida();
                            $detalle_salida->salida_id = $encabezado->id;
                            $detalle_salida->producto_id = $detalle['producto_id'];
                            $detalle_salida->cantidad = $detalle['cantidad'];
                            $detalle_salida->save();
                        } else {
                            DB::rollback();
                            return response()->json([
                                'status' => 'error',
                                'message' => 'El producto ' . $detalle['nombre_producto'] . ' no cuenta con suficiente existencia'
                            ]);
                        }
                    } catch(\Throwable $th) {
                        DB::rollBack();
                    }
                }
            }

            DB::commit();

            return 'exitoso';
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }





        // if($encabezado)
        //     return 'exitoso';
    }

    public function obtenerCabeceraSalida($request)
    {
        return $this->getModel()
        ->join('empleados', 'empleados.id', '=', 'salidas.empleado_id')
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->select(
            'salidas.codigo',
            'salidas.fecha_registro',
            'salidas.fecha_salida',
            'empleados.nombre as nombre_empleado',
            'empleados.apellido as apellido_empleado',
            'areas.nombre as nombre_area'
        )
        ->where('salidas.id', $request)
        ->take(1)
        ->get();
    }

    public function obtenerDetalleSalida($request)
    {
        return
        DetalleSalida::join('productos', 'productos.id', '=', 'detalle_salida.producto_id')
        ->select(
            'detalle_salida.cantidad',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto'
        )
        ->where('detalle_salida.salida_id', $request)
        ->orderBy('productos.id', 'asc')
        ->get();
    }

    public function obtenerPdf($request)
    {

    }
}
