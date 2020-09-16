<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movimiento\MovimientoRequest;
use Illuminate\Http\Request;
use App\Repositories\Movimiento\MovimientoRepository;

use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    protected $movimientoRepository;

    public function __construct(MovimientoRepository $movimientoRepository)
    {
        $this->movimientoRepository = $movimientoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->movimientoRepository->index(
            ['id', 'tipo_movimiento_id', 'no_transaccion', 'monto', 'observacion']
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardar = $this->movimientoRepository->movimiento($request->only(
            'tipo_movimiento_id', 'monto', 'observacion')
            + ['no_transaccion' => 'TRANSACCIÓN-' . $this->movimientoRepository->generateCode()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovimientoRequest $request, $id)
    {
        //
    }
}
