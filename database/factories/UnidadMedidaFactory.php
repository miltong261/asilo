<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UnidadMedida;
use Faker\Generator as Faker;

$factory->define(UnidadMedida::class, function (Faker $faker) {
    return [
        'codigo' => '1',
        'nombre' => $faker->name,
        'medicamento' => $faker->boolean,
        'producto' => $faker->boolean
    ];
});
