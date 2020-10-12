<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Compra\CompraRequest;
use App\Repositories\Compra\CompraRepository;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CompraController extends Controller
{
    protected $compraRepository;

    public function __construct(CompraRepository $compraRepository)
    {
        $this->compraRepository = $compraRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->compraRepository->indexCompra());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraRequest $request)
    {
        return $this->compraRepository->storeCompra($request->only([
            'fecha_compra', 'documento', 'total'])
            + ['fecha_registro' => Carbon::now()]
            + ['codigo' => 'ADQUISICIÓN-' . $this->compraRepository->generateCode()],
            $request->arrayData
        );
    }

    public function cabecera(Request $request)
    {
        return response()->json($this->compraRepository->obtenerCabeceraCompra($request->id));
    }

    public function detalle(Request $request)
    {
        return response()->json($this->compraRepository->obtenerDetalleCompra($request->id));
    }

    public function pdf($id)
    {
        return $compraRepository->pdfCompra($id);
    }
}
