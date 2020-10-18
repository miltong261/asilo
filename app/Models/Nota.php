<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    protected $fillable = [
        'user_id',
        'residente_id',
        'fecha_registro',
        'hora',
        'nota'
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
