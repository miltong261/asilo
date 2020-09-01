<?php

namespace App\Repositories\Example;

use App\Models\Example;
use App\Repositories\BaseRepository;

class ExampleRepository extends BaseRepository
{
    public function getModel()
    {
        return new Example();
    }
}
