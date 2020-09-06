<?php

namespace App\Repositories\UnidadMedida;

use App\Models\UnidadMedida;
use App\Repositories\BaseRepository;
class UnidadMedidaRepository extends BaseRepository
{
    public function getModel()
    {
        return new UnidadMedida();
    }
}
