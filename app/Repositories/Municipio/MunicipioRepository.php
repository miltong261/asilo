<?php

namespace App\Repositories\Municipio;

use App\Models\Municipio;
use App\Repositories\BaseRepository;

class MunicipioRepository extends BaseRepository
{
    public function getModel()
    {
        return new Municipio();
    }

    public function indexMunicipio()
    {
        return $this->getModel()
        ->join('departamentos', 'departamentos.id', '=', 'municipios.departamento_id')
        ->select('municipios.*', 'departamentos.nombre as departamento_nombre')
        ->orderBy('departamentos.nombre', 'asc')
        ->get();
    }
}
