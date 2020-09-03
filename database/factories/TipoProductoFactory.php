<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TipoProducto;
use Faker\Generator as Faker;

$factory->define(TipoProducto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'codigo' => '1'
    ];
});
