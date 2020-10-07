<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Area\AreaRequest;
use Illuminate\Http\Request;
use App\Repositories\Area\AreaRepository;

use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->areaRepository->index(
            ['id', 'codigo', 'nombre', 'estado']
        ));
    }

    public function combobox()
    {
        return response()->json($this->areaRepository->listarCombo(
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
    public function store(AreaRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->areaRepository->store($request->only(
                'nombre')
                + ['codigo' => 'ÁREA-' . $this->areaRepository->generateCode()]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se guardó correctamente el área ' . $request->nombre
            ]);
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
    public function update(AreaRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->areaRepository->update($request->only(
                'nombre'),
                $request->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizó correctamente el área ' . $request->nombre
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->areaRepository->estado('activar', $request->id);

            if ($activar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se activó el área'
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

            $desactivar = $this->areaRepository->estado('desactivar', $request->id);

            if ($desactivar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se desactivó el área ' .$request->nombre
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
