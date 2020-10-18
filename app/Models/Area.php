<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = [
        'codigo',
        'nombre',
        'estado'
    ];

    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado');
    }
}
