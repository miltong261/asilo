<?php

namespace App\Repositories\Donante;

use App\Models\Donante;
use App\Repositories\BaseRepository;

class DonanteRepository extends BaseRepository
{
    public function getModel()
    {
        return new Donante();
    }
}
