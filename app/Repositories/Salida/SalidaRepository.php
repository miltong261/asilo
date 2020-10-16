<?php

namespace App\Repositories\Salida;

use App\Models\Salida;
use App\Models\DetalleSalida;
use App\Models\Producto;
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
        ->join('users', 'users.id', '=', 'salidas.user_id')
        ->join('empleados', 'empleados.id', '=', 'salidas.empleado_id')
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->select(
            'salidas.*',
            'users.usuario as nombre_usuario',
            'empleados.nombre as nombre_empleado',
            'empleados.apellido as apellido_empleado',
            'areas.nombre as nombre_area'
        )
        ->orderBy('codigo', 'desc')
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

                            $ultima_salida = Producto::findOrFail($detalle_salida->producto_id);
                            $ultima_salida->update(['fecha_ultima_salida' => $request['fecha_registro']]);
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
    }

    public function obtenerCabeceraSalida($request)
    {
        return $this->getModel()
        ->join('users', 'users.id', '=', 'salidas.user_id')
        ->join('empleados', 'empleados.id', '=', 'salidas.empleado_id')
        ->join('areas', 'areas.id', '=', 'empleados.area_id')
        ->select(
            'users.usuario as nombre_usuario',
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
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->select(
            'detalle_salida.cantidad',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto',
            'unidad_medida.nombre as nombre_unidad'
        )
        ->where('detalle_salida.salida_id', $request)
        ->orderBy('productos.id', 'asc')
        ->get();
    }

    public function pdfSalida($id)
    {
        $encabezado_salida = $this->obtenerCabeceraSalida($id);
        $detalle_salida = $this->obtenerDetalleSalida($id);

        $pdf = \PDF::loadView('pdf.reporte-salidas', compact('encabezado_salida', 'detalle_salida'));
        return $pdf->download('pdf-'.$encabezado_salida[0]->codigo.'.pdf');
    }
}
