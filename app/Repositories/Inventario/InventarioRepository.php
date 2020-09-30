<?php

namespace App\Repositories\Inventario;

use App\Models\Inventario;
use App\Repositories\BaseRepository;

class InventarioRepository extends BaseRepository
{
    public function getModel()
    {
        return new Inventario();
    }

    public function inventarioProducto()
    {
        return $this->getModel()
        ->join('productos', 'productos.id', '=', 'inventario.producto_id')
        ->select('productos.id', 'productos.nombre')
        ->where('productos.asignacion', '1')
        ->get();
    }

    public function inventarioMedicamento()
    {
        return $this->getModel()
        ->join('productos', 'productos.id', '=', 'inventario.producto_id')
        ->select('productos.id', 'productos.nombre')
        ->where('productos.asignacion', '0')
        ->get();
    }
}
