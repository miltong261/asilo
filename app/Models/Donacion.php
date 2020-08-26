<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function donante()
    {
        return $this->belongsTo('App\Models\Donante');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto');
    }
}
