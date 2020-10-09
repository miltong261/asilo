<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Puesto;
use Faker\Generator as Faker;

$factory->define(Puesto::class, function (Faker $faker) {
    return [
        'codigo' => '1',
        'nombre' => $faker->name
    ];
});
