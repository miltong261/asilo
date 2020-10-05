<?php

namespace App\Repositories\Departamento;

use App\Models\Departamento;
use App\Repositories\BaseRepository;

class DepartamentoRepository extends BaseRepository
{
    public function getModel()
    {
        return new Departamento();
    }

    public function comboDepartamento(array $fields, $orderField)
    {
        return $this->getModel()
        ->select($fields)
        ->orderBy($orderField, 'asc')
        ->get();
    }
}
