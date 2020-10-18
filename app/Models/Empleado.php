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

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto');
    }
}
