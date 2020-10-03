<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignoVital extends Model
{
    protected $table = 'signos_vitales';
    protected $fillable = [
        'residente_id',
        'fecha_registro',
        'hora_registro',
        'tiempo',
        'pulso',
        'temperatura',
        'presion',
        'peso'
    ];

    public function residente()
    {
        return $this->belongsTo('App\Models\Residente');
    }
}
