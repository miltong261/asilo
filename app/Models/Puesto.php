<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puestos';
    protected $fillable = [ 'codigo', 'nombre', 'descripcion', 'estado'];

    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado');
    }
}
