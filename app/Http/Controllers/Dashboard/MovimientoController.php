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

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->movimientoRepository->indexMovimiento());
    }

    public function showSaldo()
    {
        return response()->json($this->movimientoRepository->saldoCaja());
    }

    public function store(MovimientoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->movimientoRepository->movimiento('guardar', $request->only([
                'tipo_movimiento_id', 'monto', 'observacion'])
                + ['caja_id' => 1]
                + ['fecha_registro' => Carbon::now()]
                + ['no_transaccion' => 'TRANSACCION- ' . $this->movimientoRepository->generateCode()]
                + ['user_id' => \Auth::user()->id],
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
