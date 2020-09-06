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

            $guardar = $this->unidadMedidaRepository->storeWithMedicamentoProducto([
                'codigo' => 'U-MEDIDA-' . $this->unidadMedidaRepository->generateCode(),
                'nombre' => $request->nombre,
                'medicamento' => $request->medicamento,
                'producto' => $request->producto
            ]);

            if($guardar){
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó correctamente ' . $request->nombre
                ], 200);
            }else{
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

            $actualizar = $this->unidadMedidaRepository->updateWithMedicamentoProducto([
                'nombre' => $request->nombre,
                'medicamento' => $request->medicamento,
                'producto' => $request->producto
            ], $request->id);

            if($actualizar){
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Se actualizó correctamente ' . $request->nombre
                ], 200);
            }else{
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
