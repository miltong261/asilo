<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
            ['id', 'codigo', 'nombre', 'entrada', 'salida']
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->movimientoRepository->storeMovimiento($request->only([
                'nombre', 'entrada', 'salida'
                ])
                + ['codigo' => 'MOVIMIENTO-' . $this->movimientoRepository->generateCode()]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente el movimiento ' .$request->nombre
                ]);
            }
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
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->movimientoRepository->updateMovimiento($request->only([
                'nombre', 'entrada', 'salida'
                ]), $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente el movimiento ' .$request->nombre
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }
}
