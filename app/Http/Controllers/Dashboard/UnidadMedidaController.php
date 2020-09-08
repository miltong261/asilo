<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnidadMedida\UnidadMedidaRequest;
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
    public function index()
    {
        return response()->json($this->unidadMedidaRepository->index(
            ['id', 'codigo', 'nombre', 'medicamento', 'producto', 'estado']
        ));
    }

    public function comboboxMedicamento()
    {
        return response()->json($this->unidadMedidaRepository->listarCombo(
            ['id', 'nombre']
            , 'medicamento'
            , 'nombre'
        ));
    }

    public function comboboxProducto()
    {
        return response()->json($this->unidadMedidaRepository->listarCombo(
            ['id', 'nombre']
            , 'producto'
            , 'nombre'
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

            $guardar = $this->unidadMedidaRepository->storeWithMedicamentoProducto($request->only([
                'nombre', 'medicamento', 'producto'
                ])
                + ['codigo' => 'U_MEDIDA-' . $this->unidadMedidaRepository->generateCode()]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente la unidad de medida ' . $request->nombre
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Debe marcar almenos una opción'
                ]);
            }
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
    public function update(UnidadMedidaRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->unidadMedidaRepository->updateWithMedicamentoProducto($request->only([
                'nombre', 'medicamento', 'producto'
                ]), $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente la unidad de medida ' . $request->nombre
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Debe marcar almenos una opción'
                ]);
            }

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
