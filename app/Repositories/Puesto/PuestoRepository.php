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

    public function comboboxPuesto()
    {
        return $this->getModel()
        ->select('id', 'nombre')
        ->where('nombre', '!=', 'Administrador')
        ->where('estado', 1)
        ->orderBy('nombre', 'asc')
        ->get();
    }
}
