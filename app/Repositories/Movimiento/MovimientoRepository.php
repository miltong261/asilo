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
        ->join('tipo_movimiento', 'tipo_movimiento.id', '=', 'movimientos.tipo_movimiento_id')
        ->select('movimientos.*',
            'tipo_movimiento.nombre as tipo_movimiento_nombre',
            'tipo_movimiento.entrada',
            'tipo_movimiento.salida'
        )
        ->orderBy('movimientos.fecha_registro', 'desc')
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

        if ($entrada == true) {
            $monto_anterior = $object->monto;
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
                $monto_anterior = $object->monto;
                $caja->saldo = ($caja->saldo + $monto_anterior) - ($request['monto']);

                $object->update($request);
                $caja->update(['saldo' => $caja->saldo]);

                return 'exitoso';
            }
        }
    }
}
