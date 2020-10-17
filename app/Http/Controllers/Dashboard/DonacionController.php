<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Donacion\DonacionRequest;
use Illuminate\Http\Request;
use App\Repositories\Donacion\DonacionRepository;

use Carbon\Carbon;

class DonacionController extends Controller
{
    protected $donacionRepository;

    public function __construct(DonacionRepository $donacionRepository)
    {
        $this->donacionRepository = $donacionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->donacionRepository->indexDonacion());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonacionRequest $request)
    {
        if ($request->donador == '')
            $request->merge(['donador' => 'Anónimo']);
        if ($request->direccion == '')
            $request->merge(['direccion' => 'Retalhuleu, Retalhuleu']);
        $guardar = $this->donacionRepository->storeDonacion($request->only([
            'donador', 'direccion', 'fecha_donacion'])
            + ['fecha_registro' => Carbon::now()]
            + ['codigo' => 'DONACIÓN-' . $this->donacionRepository->generateCode()]
            + ['user_id' => \Auth::user()->id],
            $request->arrayData
        );

        if ($guardar == 'exitoso') {
            return response()->json([
                'status' => 'success',
                'message' => 'Se generó la donación correctamente'
            ]);
        }
    }

    public function cabecera(Request $request)
    {
        return response()->json($this->donacionRepository->obtenerCabeceraDonacion($request->id));
    }

    public function detalle(Request $request)
    {
        return response()->json($this->donacionRepository->obtenerDetalleDonacion($request->id));
    }

    public function pdf($id)
    {
        return $this->donacionRepository->pdfDonacion($id);
    }
}
