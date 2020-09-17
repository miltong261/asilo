<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movimiento\MovimientoRequest;
use Illuminate\Http\Request;
use App\Repositories\Movimiento\MovimientoRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    protected $movimientoRepository;

    public function __construct(MovimientoRepository $movimientoRepository)
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
        return response()->json($this->movimientoRepository->indexMovimiento());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimientoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->movimientoRepository->movimiento('guardar', $request->only([
                'tipo_movimiento_id', 'monto', 'observacion'])
                + ['caja_id' => 1]
                + ['fecha_registro' => Carbon::now()]
                + ['no_transaccion' => 'TRANSACCION- ' . $this->movimientoRepository->generateCode()],
                $request->entrada,
                $request->salida,
                null
            );

            if ($guardar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó con éxito la transacción con el monto de ' . $request->monto
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
    public function update(MovimientoRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->movimientoRepository->movimiento('actualizar', $request->only(
                'tipo_movimiento_id', 'monto', 'observacion')
                + ['caja_id' => 1],
                $request->entrada,
                $request->salida,
                $request->id
            );

            if ($actualizar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó con éxito la transacción con el monto de ' . $request->monto
                ]);
            } else
                return $actualizar;

        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
