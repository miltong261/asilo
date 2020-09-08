<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Producto\ProductoRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoController extends Controller
{
    protected $productoRepository;

    public function __construct(ProductoRepository $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->productoRepository->store($request->only([
                'unidad_medida_id', 'tipo_producto_id', 'nombre', 'existencia_inicial', 'observacion', 'fecha_vencimiento'
                ])
                + ['fecha_registro' => Carbon::now()]
                + ['asignacion' => 'producto']
                + ['codigo' => 'PRODUCTO' . $this->productoRepository->generateCode()]
            );

            if ($guardar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente al producto ' . $request->nombre
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
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->productoRepository->update($request->only([
                'unidad_medida_id', 'tipo_producto_id', 'nombre', 'existencia_inicial', 'observacion', 'fecha_vencimiento'
                ])
                , $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente al producto ' . $request->nombre
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
}
