<?php

namespace App\Repositories\Movimiento;

use App\Models\Movimiento;
use App\Repositories\BaseRepository;

class MovimientoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Movimiento();
    }

    public function movimiento(array $request)
    {
        $transaccion = $this->getModel();
        $transaccion->tipo_movimiento_id = $request['tipo_movimiento_id'];
        $transaccion->no_transaccion = 1;
        $transaccion->fecha_registro = '2020-09-15';
        $transaccion->monto = $request['monto'];
        $transaccion->observacion = $request['observacion'];

        $transaccion->save();

        return 'Se guardo con éxito';
    }
}
