<?php

namespace App\Repositories\MovimientoCaja;

use App\Models\MovimientoCaja;
use App\Repositories\BaseRepository;

class MovimientoCajaRepository extends BaseRepository
{
    public function getModel()
    {
        return new MovimientoCaja();
    }

    public function storeMovimiento(array $request)
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
        }else
            return $this->getModel()->create($request);
    }

    public function updateMovimiento(array $request, $id)
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
            $object = $this->getModel()->findOrFail($id);
            $object->update($request);

            return $object;
        }
    }
}
