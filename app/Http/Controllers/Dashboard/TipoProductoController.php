<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProducto\TipoProductoRequest;
use App\Repositories\TipoProducto\TipoProductoRepository;

use Illuminate\Support\Facades\DB;

class TipoProductoController extends Controller
{
    protected $tipoProductoRepository;

    public function __construct(TipoProductoRepository $tipoProductoRepository)
    {
        $this->tipoProductoRepository = $tipoProductoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->tipoProductoRepository->index(
            ['id', 'codigo', 'nombre', 'medicamento', 'producto', 'estado']
        ));
    }

    public function comboboxMedicamento()
    {
        return response()->json($this->tipoProductoRepository->listarCombo(
            ['id', 'nombre']
            , 'medicamento'
            , 'nombre'
        ));
    }

    public function comboboxProducto()
    {
        return response()->json($this->tipoProductoRepository->listarCombo(
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
    public function store(TipoProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->tipoProductoRepository->storeWithMedicamentoProducto($request->only([
                'nombre', 'medicamento', 'producto'
                ])
                + ['codigo' => 'CATEGORIA-' . $this->tipoProductoRepository->generateCode()]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente la categoría ' . $request->nombre
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Debe marcar almenos una opción'
                ]);
            }

        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TipoProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->tipoProductoRepository->updateWithMedicamentoProducto($request->only([
                'nombre', 'medicamento', 'producto'
                ]), $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente la categoría ' . $request->nombre
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
