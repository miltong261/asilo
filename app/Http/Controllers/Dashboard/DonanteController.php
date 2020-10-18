<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Donante\DonanteRequest;
use App\Repositories\Donante\DonanteRepository;

use Illuminate\Support\Facades\DB;

class DonanteController extends Controller
{
    protected $donanteRepository;

    public function __construct(DonanteRepository $donanteRepository)
    {
        $this->donanteRepository = $donanteRepository;
    }

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

    public function store(DonanteRequest $request)
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

    public function update(DonanteRequest $request)
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
