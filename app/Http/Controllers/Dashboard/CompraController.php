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

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->compraRepository->indexCompra());
    }

    public function store(CompraRequest $request)
    {
        return $this->compraRepository->storeCompra($request->only([
            'fecha_compra', 'documento', 'no_documento', 'total'])
            + ['fecha_registro' => Carbon::now()]
            + ['codigo' => 'ADQUISICIÓN-' . $this->compraRepository->generateCode()]
            + ['user_id' => \Auth::user()->id],
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
        return $this->compraRepository->pdfCompra($id);
    }
}
