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

    public function combobox()
    {
        return response()->json($this->tipoProductoRepository->listarCombo(
            ['id', 'nombre'], 'nombre'
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

            $guardar = $this->tipoProductoRepository->storeWithMedicamentoProducto([
                'codigo' => 'CATEGORIA-' . $this->tipoProductoRepository->generateCode(),
                'nombre' => $request->nombre,
                'medicamento' => $request->medicamento,
                'producto' => $request->producto
            ]);

            if ($guardar) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente ' . $request->nombre
                ], 200);
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

            $actualizar = $this->tipoProductoRepository->updateWithMedicamentoProducto([
                'nombre' => $request->nombre,
                'medicamento' => $request->medicamento,
                'producto' => $request->producto
            ], $request->id);

            if ($actualizar) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente ' . $request->nombre
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
