<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $fillable = [
        'area_id',
        'puesto_id',
        'codigo',
        'fecha_ingreso',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'dpi',
        'direccion',
        'telefono',
        'estado'
    ];
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto');
    }
}
