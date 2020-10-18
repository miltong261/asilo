<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departamento\DepartamentoRequest;
use Illuminate\Http\Request;
use App\Repositories\Departamento\DepartamentoRepository;

use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    protected $departamentoRepository;

    public function __construct(DepartamentoRepository $departamentoRepository)
    {
        $this->departamentoRepository = $departamentoRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->departamentoRepository->index(
            ['id', 'nombre']
        ));
    }

    public function combobox()
    {
        return response()->json($this->departamentoRepository->comboDepartamento(
            ['id', 'nombre'],
            'nombre'
        ));
    }

    public function store(DepartamentoRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->departamentoRepository->store($request->only(
                'nombre'
            ));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se guardó correctamente al departamento ' .$request->nombre
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function update(DepartamentoRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->departamentoRepository->update($request->only(
                'nombre'
            ), $request->id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Se actualizó correctamente al departamento ' .$request->nombre
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
