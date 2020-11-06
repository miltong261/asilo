<?php

namespace App\Repositories\Donacion;

use App\Models\Donacion;
use App\Models\DetalleDonacion;
use App\Models\Producto;
use App\Models\Inventario;
use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\DB;

class DonacionRepository extends BaseRepository
{
    public function getModel()
    {
        return new Donacion();
    }

    public function indexDonacion()
    {
        return $this->getModel()
        ->join('users', 'users.id', '=', 'donaciones.user_id')
        ->select('donaciones.id',
            'donaciones.codigo',
            'donaciones.donador',
            'donaciones.direccion',
            'donaciones.fecha_registro',
            'donaciones.fecha_donacion',
            'users.usuario as nombre_usuario'
        )
        ->orderBy('donaciones.codigo', 'desc')
        ->get();
    }

    public function reporteDonaciones($month)
    {
        $anio = date('Y');
        $totalDonaciones = 0;

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

        $donaciones = $this->getModel()
        ->join('users', 'users.id', '=', 'donaciones.user_id')
        ->select('donaciones.id',
            'donaciones.codigo',
            'donaciones.donador',
            'donaciones.direccion',
            'donaciones.fecha_registro',
            'donaciones.fecha_donacion',
            'users.usuario as nombre_usuario'
        )
        ->orderBy('donaciones.codigo', 'desc')
        ->whereBetween('donaciones.fecha_donacion', [$data['inicio'], $data['fin']])
        ->whereYear('donaciones.fecha_donacion', $anio)
        ->get();

        foreach ($donaciones as $donacion) {
            $totalDonaciones++;
        }

        return ['donaciones' => $donaciones, 'total' => $totalDonaciones];
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
        ->join('users', 'users.id', '=', 'donaciones.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->select(
            'users.usuario as nombre_usuario',
            'empleados.nombre as nombre_empleado',
            'empleados.apellido as apellido_empleado',
            'donaciones.codigo',
            'donaciones.fecha_registro',
            'donaciones.fecha_donacion',
            'donaciones.donador',
            'donaciones.direccion'
        )
        ->take(1)
        ->where('donaciones.id', $request)
        ->get();
    }

    public function obtenerDetalleDonacion($request)
    {
        return
        DetalleDonacion::join('productos', 'productos.id', '=', 'detalle_donacion.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->select(
            'detalle_donacion.cantidad',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto',
            'unidad_medida.nombre as nombre_unidad'
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
