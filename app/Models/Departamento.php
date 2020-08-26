<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public function municipios()
    {
        return $this->hasMany('App\Models\Municipio');
    }
}
