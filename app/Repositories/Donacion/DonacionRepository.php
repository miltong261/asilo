<?php

namespace App\Repositories\Donacion;

use App\Models\Donacion;
use App\Models\DetalleDonacion;
use App\Models\Inventario;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;

class DonacionRepository extends BaseRepository
{
    public function getModel()
    {
        return new Donacion();
    }

    public function storeDonacion(array $request, array $data )
    {
        try {
            DB::beginTransaction();

            $encabezado = $this->getModel()->create($request);

            foreach ($data as $key => $detalle) {
                $inventario = Inventario::findOrFail($detalle['producto_id']);

                if ($inventario) {
                    try {
                        $inventario->existencia += $detalle['cantidad'];
                        $inventario->update(['existencia' => $inventario->existencia]);
                        $detalle_donacion = new DetalleDonacion();
                        $detalle_donacion->donacion_id = $encabezado->id;
                        $detalle_donacion->producto_id = $detalle['producto_id'];
                        $detalle_donacion->cantidad = $detalle['cantidad'];
                        $detalle_donacion->save();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return $th;
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

    public function obtenerCabeceraDonacion($request)
    {
        return $this->getModel()
        ->select(
            'codigo',
            'fecha_registro',
            'fecha_donacion',
            'donador',
            'direccion'
        )
        ->take(1)
        ->where('id', $request)
        ->get();
    }

    public function obtenerDetalleDonacion($request)
    {
        return
        DetalleDonacion::join('productos', 'productos.id', '=', 'detalle_donacion.producto_id')
        ->select(
            'detalle_donacion.cantidad',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto'
        )
        ->where('detalle_donacion.donacion_id', $request)
        ->orderBy('productos.id', 'asc')
        ->get();
    }

    public function pdfDonacion($id)
    {
        $encabezado_donacion = $this->obtenerCabeceraDonacion($id);
        $detalle_donacion = $this->obtenerDetalleDonacion($id);

        $pdf = \PDF::loadView('pdf.reporte-donaciones', compact('encabezado_donacion', 'detalle_donacion'));
        return $pdf->download('pdf-'.$encabezado_donacion[0]->codigo.'.pdf');
    }
}
