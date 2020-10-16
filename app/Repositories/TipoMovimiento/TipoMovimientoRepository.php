<?php

namespace App\Repositories\TipoMovimiento;

use App\Models\TipoMovimiento;
use App\Repositories\BaseRepository;

class TipoMovimientoRepository extends BaseRepository
{
    public function getModel()
    {
        return new TipoMovimiento();
    }

    /** Método para guardar y actualizar movimientos */
    public function movimiento($action, array $request, $id)
    {
        if ($request['entrada'] == true && $request['salida'] == true) {
            return response()->json([
                'status' => 'error',
                'message' => 'Solo se permite marcar una opción'
            ]);
        }
        elseif ($request['entrada'] == false && $request['salida'] == false) {
            return response()->json([
                'status' => 'error',
                'message' => 'Debe marcar almenos una opción'
            ]);
        } else {
            if ($action == 'guardar') {
                $this->getModel()->create($request);

                return 'exitoso';
            } elseif ($action == 'actualizar') {
                $object = $this->getModel()->findOrFail($id);
                $object->update($request);

                return 'exitoso';
            }
        }
    }

    public function comboboxTipoMovimiento()
    {
        return $this->getModel()
        ->select('id', 'nombre', 'entrada', 'salida', 'estado')
        ->where('estado', 1)
        ->where('nombre', '!=', 'Compra')
        ->get();
    }
}
