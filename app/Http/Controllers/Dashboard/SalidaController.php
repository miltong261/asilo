<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Salida\SalidaRequest;
use Illuminate\Http\Request;
use App\Repositories\Salida\SalidaRepository;

use Carbon\Carbon;

class SalidaController extends Controller
{
    protected $salidaRepository;

    public function __construct(SalidaRepository $salidaRepository)
    {
        $this->salidaRepository = $salidaRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->salidaRepository->indexSalida());
    }

    public function store(SalidaRequest $request)
    {
        $guardar = $this->salidaRepository->storeSalida($request->only([
            'empleado_id', 'fecha_salida', 'nota_salida'])
            + ['fecha_registro' => Carbon::now()]
            + ['codigo' => 'REQUISICIÓN-' . $this->salidaRepository->generateCode()]
            + ['user_id' => \Auth::user()->id],
            $request->arrayData
        );

        if ($guardar == 'exitoso') {
            return response()->json([
                'status' => 'success',
                'message' => 'Se generó la salida correctamente'
            ]);
        } else
            return $guardar;
    }

    public function cabecera(Request $request)
    {
        return response()->json($this->salidaRepository->obtenerCabeceraSalida($request->id));
    }

    public function detalle(Request $request)
    {
        return response()->json($this->salidaRepository->obtenerDetalleSalida($request->id));
    }

    public function pdf($id)
    {
        return $this->salidaRepository->pdfSalida($id);
    }

    public function mes(Request $request)
    {
        return $this->salidaRepository->reporteSalidas($request->mes);
    }
}
