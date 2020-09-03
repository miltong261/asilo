<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puestos';
    protected $fillable = ['nombre', 'codigo', 'estado'];

    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado');
    }
}
