<?php

namespace App\Repositories\Caja;

use App\Models\MovimientoCaja;
use App\Models\Caja;
use App\Repositories\BaseRepository;

class CajaRepository extends BaseRepository
{
    public function getModel()
    {
        return new Caja();
    }

    public function indexCaja()
    {
        return $this->getModel()
        ->join('movimiento_caja', 'movimiento_caja.id', '=', 'caja.movimiento_caja_id')
        ->select(
            'caja.*',
            'movimiento_caja.nombre as movimiento_nombre',
            'movimiento_caja.entrada as movimiento_entrada',
            'movimiento_caja.salida as movimiento_salida'
        )->get();
    }

    public function caja(array $request)
    {
        $caja = $this->getModel();
        $caja->movimiento_caja_id = $request['caja_movimiento_id'];
        $caja->no_transaccion = 1;
        $caja->fecha_registro = '2020-09-15';
        $caja->monto = $request['monto'];
        $caja->observacion = $request['observacion'];

        if ($request['entrada'] == true) {
            $caja->saldo += $request['monto'];
        }

        $caja->save();
    }
}
