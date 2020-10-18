<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Caja\CajaRepository;

use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    protected $cajaRepository;

    public function __construct(CajaRepository $cajaRepository)
    {
        $this->cajaRepository = $cajaRepository;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/asilo');
        return response()->json($this->cajaRepository->indexCaja());
    }

    public function store(Request $request)
    {
        return $this->cajaRepository->caja($request->only(
            'entrada', 'caja_movimiento_id', 'monto', 'observacion'
        ));
    }
}
