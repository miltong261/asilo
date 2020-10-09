<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donante extends Model
{
    protected $table = 'donantes';
    protected $fillable = ['codigo', 'nombre', 'direccion', 'telefono'];

    public function donaciones()
    {
        return $this->hasMany('App\Models\Donacion');
    }
}
