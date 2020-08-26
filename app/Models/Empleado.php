<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto');
    }
}
