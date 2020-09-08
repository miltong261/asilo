<?php

namespace App\Repositories\Producto;

use App\Models\UnidadMedida;
use App\Models\TipoProducto;
use App\Models\Producto;
use App\Repositories\BaseRepository;

class ProductoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Producto();
    }
}
