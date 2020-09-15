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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->cajaRepository->indexCaja());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->cajaRepository->caja($request->only(
            'entrada', 'caja_movimiento_id', 'monto', 'observacion'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
