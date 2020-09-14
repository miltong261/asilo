<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovimientoCaja\MovimientoCajaRequest;
use Illuminate\Http\Request;
use App\Repositories\MovimientoCaja\MovimientoCajaRepository;

use Illuminate\Support\Facades\DB;

class MovimientoCajaController extends Controller
{
    protected $movimientoRepository;

    public function __construct(MovimientoCajaRepository $movimientoRepository)
    {
        $this->movimientoRepository = $movimientoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->movimientoRepository->index(
            ['id', 'codigo', 'nombre', 'entrada', 'salida', 'estado']
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimientoCajaRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->movimientoRepository->movimiento('guardar', $request->only(
                'nombre', 'entrada', 'salida')
                + ['codigo' => 'MOVIMIENTO-' . $this->movimientoRepository->generateCode()]
                , null
            );

            if ($guardar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente el movimiento ' .$request->nombre
                ]);
            } else
                return $guardar;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovimientoCajaRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->movimientoRepository->movimiento('actualizar', $request->only(
                'nombre', 'entrada', 'salida')
                , $request->id
            );

            if ($actualizar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente el movimiento ' .$request->nombre
                ]);
            } else
                return $actualizar;
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->movimientoRepository->estado('activar', $request->id);

            if ($activar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se activó el movimiento'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function desactivate(Request $request)
    {
        try {
            DB::beginTransaction();

            $desactivar = $this->movimientoRepository->estado('desactivar', $request->id);

            if ($desactivar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se desactivó el movimiento ' .$request->nombre
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
