<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Donante\DonanteRepository;

use Illuminate\Support\Facades\DB;

class DonanteController extends Controller
{
    protected $donanteRepository;

    public function __construct(DonanteRepository $donanteRepository)
    {
        $this->donanteRepository = $donanteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->donanteRepository->index(
            ['id', 'codigo', 'nombre', 'direccion', 'telefono']
        ));
    }

    public function combobox()
    {
        return response()->json($this->donanteRepository->listarCombo(
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
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->donanteRepository->store($request->only(
                'nombre', 'direccion', 'telefono')
                + ['codigo' => 'DONANTE-' . $this->donanteRepository->generateCode()]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente al donante ' .$request->nombre
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

            $actualizar = $this->donanteRepository->update($request->only(
                'nombre', 'direccion', 'telefono'),
                $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente al donante ' .$request->nombre
                ]);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
