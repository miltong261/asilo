<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donante extends Model
{
    public function donaciones()
    {
        return $this->hasMany('App\Models\Donacion');
    }
}
