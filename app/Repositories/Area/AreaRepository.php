<?php

namespace App\Repositories\Area;

use App\Models\Area;
use App\Repositories\BaseRepository;

class AreaRepository extends BaseRepository
{
    public function getModel()
    {
        return new Area();
    }
}
