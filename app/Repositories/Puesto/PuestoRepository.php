<?php

namespace App\Repositories\Puesto;

use App\Models\Puesto;
use App\Repositories\BaseRepository;

class PuestoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Puesto();
    }
}
