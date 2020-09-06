<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Puesto\PuestoRequest;
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

            $this->puestoRepository->store([
                'codigo' => 'PUESTO-' . $this->puestoRepository->generateCode(),
                'nombre' => $request->nombre
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se guardó correctamente ' . $request->nombre
            ], 200);

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

            $this->puestoRepository->update([
                'nombre' => $request->nombre
            ], $request->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizó correctamente ' . $request->nombre
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
