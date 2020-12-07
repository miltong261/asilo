<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    protected $table = 'residentes';
    protected $fillable = [
        'user_id',
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
        'estado_fisico',
        'estado_medico',
        'estado_psicologico',
        'observacion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function signosVitales()
    {
        return $this->hasMany('App\Models\SignoVital');
    }

    public function notas()
    {
        return $this->hasMany('App\Models\Nota');
    }

    public function kardex()
    {
        return $this->hasMany('App\Models\Kardex');
    }
}


