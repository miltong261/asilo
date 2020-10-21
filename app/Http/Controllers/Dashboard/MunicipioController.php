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

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->municipioRepository->indexMunicipio());
    }

    public function combobox(Request $request)
    {
        return response()->json($this->municipioRepository->comboMunicipio($request->departamento_origen_id));
    }

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

    public function update(MunicipioRequest $request)
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
