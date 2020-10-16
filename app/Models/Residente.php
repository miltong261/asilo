<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    protected $table = 'residentes';
    protected $fillable = [
        'municipio_origen',
        'municipio_dpi',
        'codigo',
        'fecha_ingreso',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'dpi',
        'familia',
        'direccion',
        'telefono_familia',
        'persona_referida',
        'direccion_persona_referida',
        'telefono_persona_referida',
        'motivo',
        'estado',
        'historial',
        'observacion'
    ];

    public function signosVitales()
    {
        return $this->hasMany('App\Models\SignoVital');
    }
}
