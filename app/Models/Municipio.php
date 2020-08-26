<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public function departamento()
    {
        return $this->belongsTo('App\Models\Departamento');
    }
}
