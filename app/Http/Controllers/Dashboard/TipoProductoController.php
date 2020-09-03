<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProducto\TipoProductoRequest;

use App\Repositories\TipoProducto\TipoProductoRepository;

class TipoProductoController extends Controller
{
    protected $tipoProductoRepository;

    public function __construct(TipoProductoRepository $tipoProductoRepository)
    {
        $this->tipoProductoRepository = $tipoProductoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->tipoProductoRepository->index(
            ['id', 'nombre', 'codigo', 'estado']
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoProductoRequest $request)
    {
        $tipo_producto = $this->tipoProductoRepository->store([
            'nombre' => $request->nombre,
            'codigo' => 'CATEG-' . $this->tipoProductoRepository->generateCode()
        ]);

        return response()->json($tipo_producto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TipoProductoRequest $request)
    {
        $tipo_producto = $this->tipoProductoRepository->update([
            'nombre' => $request->nombre
        ], $request->id);

        return response()->json($tipo_producto);
    }
}
