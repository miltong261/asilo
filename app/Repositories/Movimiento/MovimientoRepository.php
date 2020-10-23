<?php

namespace App\Repositories\Movimiento;

use App\Models\Movimiento;
use App\Models\Caja;
use App\Repositories\BaseRepository;

class MovimientoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Movimiento();
    }

    public function indexMovimiento()
    {
        return $this->getModel()
        ->join('users', 'users.id', '=', 'movimientos.user_id')
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select('movimientos.*',
            'users.usuario as nombre_usuario',
            'users.rol_id',
            'tipo_movimiento.id as tipo_movimiento_id',
            'tipo_movimiento.nombre as tipo_movimiento_nombre',
            'tipo_movimiento.entrada',
            'tipo_movimiento.salida'
        )
        ->orderBy('movimientos.no_transaccion', 'desc')
        ->get();
    }

    public function saldoCaja()
    {
        return Caja::select('saldo')->get();
    }

    public function movimiento($action, array $request, $entrada, $salida, $id)
    {
        if ($action == 'guardar')
            return $this->guardar($request, $entrada, $salida);
        elseif ($action == 'actualizar')
            return $this->actualizar($request, $entrada, $salida, $id);
    }

    public function guardar(array $request, $entrada, $salida)
    {
        $caja = Caja::findOrFail($request['caja_id']);

        if ($entrada == true) {
            $caja->saldo += $request['monto'];

            $this->getModel()->create($request);
            $caja->update(['saldo' => $caja->saldo]);

            return 'exitoso';
        } elseif ($salida == true) {
            if ($caja->saldo == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'La caja no cuenta con saldo'
                ]);
            } elseif ($caja->saldo < $request['monto']) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'La caja cuenta con un saldo de Q' . $caja->saldo . ', no se puede llevar a cabo la transacción'
                ]);
            } else {
                $caja->saldo -= $request['monto'];

                $this->getModel()->create($request);
                $caja->update(['saldo' => $caja->saldo]);

                return 'exitoso';
            }
        }
    }

    public function actualizar(array $request, $entrada, $salida, $id)
    {
        $object = $this->getModel()->findOrFail($id);
        $caja = Caja::findOrFail($request['caja_id']);
        $monto_anterior = $object->monto;

        if ($entrada == true) {
            $caja->saldo = ($caja->saldo - $monto_anterior) + ($request['monto']);

            $object->update($request);
            $caja->update(['saldo' => $caja->saldo]);

            return 'exitoso';
        } elseif ($salida == true) {
            if ($caja->saldo == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'La caja no cuenta con saldo'
                ]);
            } elseif ($caja->saldo < $request['monto']) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'La caja cuenta con un saldo de Q' . $caja->saldo . ', no se puede llevar a cabo la transacción'
                ]);
            } else {
                $caja->saldo = ($caja->saldo + $monto_anterior) - ($request['monto']);

                $object->update($request);
                $caja->update(['saldo' => $caja->saldo]);

                return 'exitoso';
            }
        }
    }

    public function saldoMes($month)
    {
        $anio = date('Y');
        $montoSalida = 0;
        $montoEntrada = 0;
        $caja = $this->saldoCaja();
        $saldoInicial = 0;

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

        $movimientos = $this->getModel()
        ->join('users', 'users.id', '=', 'movimientos.user_id')
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select('movimientos.*',
            'users.usuario as nombre_usuario',
            'users.rol_id',
            'tipo_movimiento.id as tipo_movimiento_id',
            'tipo_movimiento.nombre as tipo_movimiento_nombre',
            'tipo_movimiento.entrada',
            'tipo_movimiento.salida'
        )
        ->orderBy('movimientos.no_transaccion', 'desc')
        ->whereBetween('movimientos.fecha_registro', [$data['inicio'], $data['fin']])
        ->whereYear('movimientos.fecha_registro', $anio)
        ->get();

        foreach ($movimientos as $movimiento) {
            if ($movimiento->salida == 1)
                $montoSalida += $movimiento->monto;
        }

        foreach ($movimientos as $movimiento) {
            if ($movimiento->entrada == 1)
                $montoEntrada += $movimiento->monto;
        }

        $saldoInicial = $caja[0]['saldo'] + $montoSalida - $montoEntrada ;

        if ($movimientos == '') {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay registro de notas para la fecha '
            ]);
        } else {
            return ['movimientos' => $movimientos, 'salida' => $montoSalida, 'entrada' => $montoEntrada, 'saldo_inicial' => $saldoInicial, 'saldo_actual' => $caja[0]['saldo']];
        }
    }
}
