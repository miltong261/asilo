<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoMovimiento\TipoMovimientoRequest;
use Illuminate\Http\Request;
use App\Repositories\TipoMovimiento\TipoMovimientoRepository;

use Illuminate\Support\Facades\DB;

class TipoMovimientoController extends Controller
{
    protected $tipoMovimientoRepository;

    public function __construct(TipoMovimientoRepository $tipoMovimientoRepository)
    {
        $this->tipoMovimientoRepository = $tipoMovimientoRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->tipoMovimientoRepository->index(
            ['id', 'codigo', 'nombre', 'entrada', 'salida', 'estado']
        ));
    }

    public function combobox()
    {
        return response()->json($this->tipoMovimientoRepository->comboboxTipoMovimiento());
    }

    public function store(TipoMovimientoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->tipoMovimientoRepository->movimiento('guardar', $request->only(
                'nombre', 'entrada', 'salida')
                + ['codigo' => 'MOVIMIENTO-' . $this->tipoMovimientoRepository->generateCode()],
                null
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

    public function update(TipoMovimientoRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->tipoMovimientoRepository->movimiento('actualizar', $request->only(
                'nombre', 'entrada', 'salida'),
                $request->id
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

            $activar = $this->tipoMovimientoRepository->estado('activar', $request->id);

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

            $desactivar = $this->tipoMovimientoRepository->estado('desactivar', $request->id);

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
