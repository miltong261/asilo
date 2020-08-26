<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
