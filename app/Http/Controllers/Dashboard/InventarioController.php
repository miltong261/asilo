<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Inventario\InventarioRepository;

class InventarioController extends Controller
{
    private $inventarioRepository;

    public function __construct(InventarioRepository $inventarioRepository)
    {
        $this->inventarioRepository = $inventarioRepository;
    }

    public function listarProducto()
    {
        return response()->json($this->inventarioRepository->inventarioProducto());
    }

    public function listarMedicamento()
    {
        return response()->json($this->inventarioRepository->inventarioMedicamento());
    }
}
