<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\ProductoRequest;
use Illuminate\Http\Request;
use App\Repositories\Producto\ProductoRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicamentoController extends Controller
{
    protected $medicamentoRepository;

    public function __construct(ProductoRepository $medicamentoRepository)
    {
        $this->medicamentoRepository = $medicamentoRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->medicamentoRepository->indexProducto('medicamento'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->medicamentoRepository->storeProduct($request->only([
                'unidad_medida_id', 'tipo_producto_id', 'nombre', 'presentacion', 'observacion', 'fecha_vencimiento'
                ])
                + ['fecha_registro' => Carbon::now()]
                + ['asignacion' => 0]
                + ['codigo' => 'MEDICAMENTO-' . $this->medicamentoRepository->generateCodeProduct('medicamento')]
                + ['user_id' => \Auth::user()->id]
            );

            if ($guardar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente al medicamento ' . $request->nombre
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocurrio un error'
                ]);
            }
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
    public function update(ProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->medicamentoRepository->update($request->only([
                'unidad_medida_id', 'tipo_producto_id', 'nombre', 'observacion', 'fecha_vencimiento'
                ]),
                $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente al medicamento ' . $request->nombre
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ocurrio un error'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
    }

    public function activate(Request $request)
    {
        try {
            DB::beginTransaction();

            $activar = $this->medicamentoRepository->estado('activar', $request->id);

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

            $desactivar = $this->medicamentoRepository->estado('desactivar', $request->id);

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
