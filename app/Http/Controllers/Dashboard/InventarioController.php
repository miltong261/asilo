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

    public function comboboxProducto()
    {
        return response()->json($this->inventarioRepository->inventarioProducto());
    }

    public function comboboxMedicamento()
    {
        return response()->json($this->inventarioRepository->inventarioMedicamento());
    }

    public function listarProductosSalidas()
    {
        return response()->json($this->inventarioRepository->inventarioSalidas('producto'));
    }

    public function listarMedicamentosSalidas()
    {
        return response()->json($this->inventarioRepository->inventarioSalidas('medicamento'));
    }

    public function listarProductosEntradas()
    {
        return response()->json($this->inventarioRepository->inventarioEntradas('producto'));
    }

    public function listarMedicamentosEntradas()
    {
        return response()->json($this->inventarioRepository->inventarioEntradas('medicamento'));
    }
}
