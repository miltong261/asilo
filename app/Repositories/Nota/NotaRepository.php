<?php

namespace App\Repositories\Nota;

use App\Models\Residente;
use App\Models\Nota;
use App\Repositories\BaseRepository;

class NotaRepository extends BaseRepository
{
    public function getModel()
    {
        return new Nota();
    }
}
