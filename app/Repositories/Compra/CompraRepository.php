<?php

namespace App\Repositories\Compra;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\TipoMovimiento;
use App\Models\Movimiento;
use App\Models\Caja;
use App\Repositories\BaseRepository;
use App\Repositories\Movimiento\MovimientoRepository;

use Illuminate\Support\Facades\DB;

class CompraRepository extends BaseRepository
{
    protected $movimientoRepository;

    public function __construct(MovimientoRepository $movimientoRepository)
    {
        $this->movimientoRepository = $movimientoRepository;
    }

    public function getModel()
    {
        return new Compra();
    }

    public function indexCompra()
    {
        return $this->getModel()
        ->join('users', 'users.id', '=', 'compras.user_id')
        ->select('compras.id',
            'compras.codigo',
            'compras.fecha_registro',
            'compras.fecha_compra',
            'compras.documento',
            'compras.no_documento',
            'compras.total',
            'users.usuario as nombre_usuario'
        )
        ->orderBy('compras.codigo', 'desc')
        ->get();
    }

    public function reporteCompras($month)
    {
        $anio = date('Y');
        $totalCompras = 0;
        $totalTotal = 0;

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

        $compras = $this->getModel()
        ->join('users', 'users.id', '=', 'compras.user_id')
        ->select('compras.id',
            'compras.codigo',
            'compras.fecha_registro',
            'compras.fecha_compra',
            'compras.documento',
            'compras.no_documento',
            'compras.total',
            'users.usuario as nombre_usuario'
        )
        ->orderBy('compras.codigo', 'desc')
        ->whereBetween('compras.fecha_compra', [$data['inicio'], $data['fin']])
        ->whereYear('compras.fecha_compra', $anio)
        ->get();

        foreach ($compras as $compra) {
            $totalCompras++;
            $totalTotal += $compra->total;
        }

        return ['compras' => $compras, 'total' => $totalCompras, 'totalTotal' => $totalTotal];
    }

    public function storeCompra(array $request, array $data)
    {
        try {
            DB::beginTransaction();

            $caja = Caja::findOrFail(1);

            if ($caja->saldo < $request['total']){
                DB::rollback();

                return response()->json([
                    'status' => 'error',
                    'message' => 'El saldo de caja es insuficiente, saldo en caja ' . $caja->saldo
                ]);
            } else {
                try {
                    $encabezado = $this->getModel()->create($request);

                    foreach ($data as $key => $detalle) {
                        $inventario = Inventario::findOrFail($detalle['producto_id']);

                        if ($inventario) {
                            try {
                                $inventario->existencia += $detalle['cantidad'];
                                $inventario->update(['existencia' => $inventario->existencia]);

                                $detalle_compra = new DetalleCompra();
                                $detalle_compra->compra_id = $encabezado->id;
                                $detalle_compra->producto_id = $detalle['producto_id'];
                                $detalle_compra->cantidad = $detalle['cantidad'];
                                $detalle_compra->precio = $detalle['precio'];
                                $detalle_compra->save();

                                $ultima_compra = Producto::findOrFail($detalle_compra->producto_id);
                                $ultima_compra->update(['fecha_ultima_compra' => $request['fecha_registro']]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return $th;
                            }
                        }
                    }

                    $movimiento = new Movimiento();
                    $movimiento->user_id = $request['user_id'];
                    $movimiento->caja_id = 1;
                    $movimiento->tipo_movimiento_id = 1;
                    $movimiento->no_transaccion = 'TRANSACCIÓN-' . $this->movimientoRepository->generateCode();
                    $movimiento->fecha_registro = $request['fecha_registro'];
                    $movimiento->monto = $request['total'];
                    $movimiento->observacion = 'Código de compra, ' . $request['codigo'];
                    $movimiento->save();

                    $caja->update(['saldo' => ($caja->saldo - $request['total'])]);

                    DB::commit();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Se realizó la compra correctamente'
                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return $th;
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function obtenerCabeceraCompra($request)
    {
        return $this->getModel()
        ->join('users', 'users.id', '=', 'compras.user_id')
        ->join('empleados', 'empleados.id', '=', 'users.empleado_id')
        ->select(
            'users.usuario as nombre_usuario',
            'empleados.nombre as nombre_empleado',
            'empleados.apellido as apellido_empleado',
            'compras.codigo',
            'compras.fecha_registro',
            'compras.fecha_compra',
            'compras.documento',
            'compras.no_documento',
            'compras.total'
        )
        ->take(1)
        ->where('compras.id', $request)
        ->get();
    }

    public function obtenerDetalleCompra($request)
    {
        return
        DetalleCompra::join('productos', 'productos.id', '=', 'detalle_compra.producto_id')
        ->join('unidad_medida', 'unidad_medida.id', '=', 'productos.unidad_medida_id')
        ->select(
            'detalle_compra.cantidad',
            'detalle_compra.precio',
            'productos.codigo as codigo_producto',
            'productos.nombre as nombre_producto',
            'productos.presentacion as presentacion_producto',
            'productos.observacion as observacion_producto',
            'unidad_medida.nombre as nombre_unidad'
        )
        ->where('detalle_compra.compra_id', $request)
        ->orderBy('productos.id', 'asc')
        ->get();
    }

    public function pdfCompra($id)
    {
        $encabezado_compra = $this->obtenerCabeceraCompra($id);
        $detalle_compra = $this->obtenerDetalleCompra($id);

        $pdf = \PDF::loadView('pdf.reporte-compras', compact('encabezado_compra', 'detalle_compra'));
        return $pdf->download('pdf-'.$encabezado_compra[0]->codigo.'.pdf');
    }
}
