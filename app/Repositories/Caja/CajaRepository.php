<?php

namespace App\Repositories\Caja;

use App\Models\Caja;
use App\Repositories\BaseRepository;

class CajaRepository extends BaseRepository
{
    public function getModel()
    {
        return new Caja();
    }
}
