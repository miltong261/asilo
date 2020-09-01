<?php

namespace App\Repositories\TipoProducto;

use App\Models\TipoProducto;
use App\Repositories\BaseRepository;

class TipoProductoRepository extends BaseRepository
{
    public function getModel()
    {
        return new TipoProducto();
    }
}
