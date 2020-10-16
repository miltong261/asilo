<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProducto\TipoProductoRequest;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->tipoProductoRepository->index(
            ['id', 'codigo', 'nombre', 'medicamento', 'producto', 'estado']
        ));
    }

    public function comboboxMedicamento()
    {
        return response()->json($this->tipoProductoRepository->listarCombo(
            ['id', 'nombre'],
            'medicamento',
            'nombre'
        ));
    }

    public function comboboxProducto()
    {
        return response()->json($this->tipoProductoRepository->listarCombo(
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
    public function store(TipoProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->tipoProductoRepository->checkboxMedicamentoProducto('guardar', $request->only(
                'nombre', 'medicamento', 'producto')
                + ['codigo' => 'CATEGORIA-' . $this->tipoProductoRepository->generateCode()]
                , null
            );

            if ($guardar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente la categoría ' . $request->nombre
                ]);
            } else
                return $guardar;
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

            $actualizar = $this->tipoProductoRepository->checkboxMedicamentoProducto('actualizar', $request->only(
                'nombre', 'medicamento', 'producto'),
                $request->id
            );

            if ($actualizar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente la categoría ' . $request->nombre
                ]);
            } else
                return $actualizar;
        } catch (\Throwable $th) {
            DB::rollBack();
        }

    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->tipoProductoRepository->estado('activar', $request->id);

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

            $desactivar = $this->tipoProductoRepository->estado('desactivar', $request->id);

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
