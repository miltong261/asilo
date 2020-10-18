<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignoVital extends Model
{
    protected $table = 'signos_vitales';
    protected $fillable = [
        'user_id',
        'residente_id',
        'fecha_registro',
        'hora_registro',
        'tiempo',
        'respiraciones',
        'presion',
        'pulso',
        'peso',
        'temperatura',
        'observacion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function residente()
    {
        return $this->belongsTo('App\Models\Residente');
    }
}
