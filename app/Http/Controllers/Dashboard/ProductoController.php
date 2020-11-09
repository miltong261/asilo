<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\ProductoRequest;
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

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        $rol = \Auth::user()->rol_id;
        return response()->json(['query' => $this->productoRepository->indexProducto('producto'), 'rol' => $rol]);
    }

    public function store(ProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->productoRepository->storeProduct($request->only([
                'unidad_medida_id', 'tipo_producto_id', 'nombre', 'presentacion', 'observacion', 'fecha_vencimiento'
                ])
                + ['fecha_registro' => Carbon::now()]
                + ['asignacion' => 1]
                + ['codigo' => 'ARTÍCULO-' . $this->productoRepository->generateCodeProduct('producto')]
                + ['user_id' => \Auth::user()->id]
            );

            if ($guardar == 'exitoso') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente al artículo ' . $request->nombre
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

    public function update(ProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $actualizar = $this->productoRepository->update($request->only([
                'unidad_medida_id', 'tipo_producto_id', 'nombre', 'presentacion', 'observacion', 'fecha_vencimiento'
                ]),
                $request->id
            );

            if ($actualizar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente el artículo ' . $request->nombre
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

            $activar = $this->productoRepository->estado('activar', $request->id);

            if ($activar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se activó el artículo ' .$request->nombre
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

            $desactivar = $this->productoRepository->estado('desactivar', $request->id);

            if ($desactivar) {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se desactivó el artículo ' .$request->nombre
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function vencimiento()
    {
        return response()->json($this->productoRepository->productoPorVencer('producto'));
    }

    public function vencido()
    {
        return response()->json($this->productoRepository->productoVencido('producto'));
    }

    public function pdf(Request $request)
    {
        return $this->productoRepository->pdfInventario('producto', $request->mes);

        // return $this->productoRepository->pdfInventario();
    }
}
