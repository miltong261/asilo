<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Puesto\PuestoRequest;

use App\Repositories\Puesto\PuestoRepository;

class PuestoController extends Controller
{
    protected $puestoRepository;

    public function __construct(PuestoRepository $puestoRepository)
    {
        $this->puestoRepository = $puestoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->puestoRepository->index(
            ['id', 'nombre']
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PuestoRequest $request)
    {
        $puesto = $this->puestoRepository->store($request->only(
            ['nombre']
        ));

        return response()->json($puesto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PuestoRequest $request)
    {
        $puesto = $this->puestoRepository->update([
            'nombre' => $request->nombre
        ], $request->id);

        return response()->json($puesto);
    }
}
