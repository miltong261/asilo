<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Municipio\MunicipioRequest;
use Illuminate\Http\Request;
use App\Repositories\Municipio\MunicipioRepository;

use Illuminate\Support\Facades\DB;
class MunicipioController extends Controller
{
    protected $municipioRepository;

    public function __construct(MunicipioRepository $municipioRepository)
    {
        $this->municipioRepository = $municipioRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->municipioRepository->indexMunicipio());
    }

    public function combobox(Request $request)
    {
        return response()->json($this->municipioRepository->comboMunicipio($request->departamento_origen_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->municipioRepository->store($request->only(
                'departamento_id', 'nombre'
            ));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se guardó correctamente al municipio ' .$request->nombre
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
    public function update(MunicipioRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $this->municipioRepository->update($request->only(
                'departamento_id', 'nombre'
            ), $request->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizó correctamente al municipio ' .$request->nombre
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
