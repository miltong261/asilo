<?php

namespace App\Repositories\Rol;

use App\Models\Rol;
use App\Repositories\BaseRepository;

class RolRepository extends BaseRepository
{
    public function getModel()
    {
        return new Rol();
    }

    public function comboboxRol()
    {
        return $this->getModel()
        ->select('id', 'nombre')
        ->where('nombre', '!=', 'Administrador')
        ->orderBy('nombre', 'asc')
        ->get();
    }
}
