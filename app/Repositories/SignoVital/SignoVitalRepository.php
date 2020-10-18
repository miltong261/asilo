<?php

namespace App\Repositories\SignoVital;

use App\Models\Residente;
use App\Models\SignoVital;
use App\Repositories\BaseRepository;

class SignoVitalRepository extends BaseRepository
{
    public function getModel()
    {
        return new SignoVital();
    }
}
