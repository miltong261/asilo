<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TipoProducto;
use Faker\Generator as Faker;

$factory->define(TipoProducto::class, function (Faker $faker) {
    return [
        'codigo' => '1',
        'nombre' => $faker->name,
        'medicamento' => $faker->boolean,
        'producto' => $faker->boolean
    ];
});
