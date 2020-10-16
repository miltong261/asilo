<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AjusteProducto\AjusteProductoRequest;
use Illuminate\Http\Request;
use App\Repositories\AjusteProducto\AjusteProductoRepository;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AjusteProductoController extends Controller
{
    private $ajusteRepository;

    public function __construct(AjusteProductoRepository $ajusteRepository)
    {
        $this->ajusteRepository = $ajusteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProducto(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->ajusteRepository->indexAjuste('producto'));
    }

    public function indexMedicamento(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->ajusteRepository->indexAjuste('medicamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AjusteProductoRequest $request)
    {
        try {
            DB::beginTransaction();

            $guardar = $this->ajusteRepository->ajuste($request->only([
                'producto_id', 'cantidad', 'entrada', 'salida', 'observacion'])
                + ['fecha_registro' => Carbon::now()],
                null
            );

            if ($guardar == 'exito') {
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Se guardó con éxito el ajuste del producto '
                ]);
            } else
                return $guardar;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
