<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Puesto\PuestoRequest;
use Illuminate\Http\Request;
use App\Repositories\Puesto\PuestoRepository;

use Illuminate\Support\Facades\DB;

class PuestoController extends Controller
{
    protected $puestoRepository;

    public function __construct(PuestoRepository $puestoRepository)
    {
        $this->puestoRepository = $puestoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->puestoRepository->index(
            ['id', 'nombre', 'codigo', 'estado']
        ));
    }

    public function combobox()
    {
        return response()->json($this->puestoRepository->listarCombo(
            ['id', 'nombre'],
            null,
            'nombre'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PuestoRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->puestoRepository->store($request->only(
                'nombre')
                + ['codigo' => 'PUESTO-' . $this->puestoRepository->generateCode()]
            );

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se guardó correctamente el puesto ' . $request->nombre
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PuestoRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->puestoRepository->update($request->only(
                'nombre'),
                $request->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizó correctamente el puesto ' . $request->nombre
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->puestoRepository->estado('activar', $request->id);

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

            $desactivar = $this->puestoRepository->estado('desactivar', $request->id);

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
