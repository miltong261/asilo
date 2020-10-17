<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadMedida\UnidadMedidaRequest;
use Illuminate\Http\Request;
use App\Repositories\UnidadMedida\UnidadMedidaRepository;

use Illuminate\Support\Facades\DB;

class UnidadMedidaController extends Controller
{
    protected $unidadMedidaRepository;

    public function __construct(UnidadMedidaRepository $unidadMedidaRepository)
    {
        $this->unidadMedidaRepository = $unidadMedidaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        $rol = \Auth::user()->rol_id;
        return response()->json(['query' => $this->unidadMedidaRepository->index(
            ['id', 'codigo', 'nombre', 'medicamento', 'producto', 'estado']
        ), 'rol' => $rol]);
    }

    public function comboboxMedicamento()
    {
        return response()->json($this->unidadMedidaRepository->listarCombo(
            ['id', 'nombre'],
            'medicamento',
            'nombre'
        ));
    }

    public function comboboxProducto()
    {
        return response()->json($this->unidadMedidaRepository->listarCombo(
            ['id', 'nombre'],
            'producto',
            'nombre'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadMedidaRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->unidadMedidaRepository->checkboxMedicamentoProducto('guardar', $request->only(
                'nombre', 'medicamento', 'producto')
                + ['codigo' => 'U_MEDIDA-' . $this->unidadMedidaRepository->generateCode()],
                null
            );

            if ($guardar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente la unidad de medida ' . $request->nombre
                ]);
            } else
                return $guardar;
        } catch (\Throwable $th) {
            DB::rollBack();
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
    public function update(UnidadMedidaRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->unidadMedidaRepository->checkboxMedicamentoProducto('actualizar', $request->only(
                'nombre', 'medicamento', 'producto'),
                $request->id
            );

            if ($actualizar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente la unidad de medida ' . $request->nombre
                ]);
            }
            else
                return $actualizar;
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->unidadMedidaRepository->estado('activar', $request->id);

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

            $desactivar = $this->unidadMedidaRepository->estado('desactivar', $request->id);

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
