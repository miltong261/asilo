<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table = 'donaciones';
    protected $fillable = [
        'user_id',
        'codigo',
        'fecha_registro',
        'fecha_donacion',
        'donador',
        'direccion'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
