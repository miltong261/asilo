<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Puesto;
use App\Models\Empleado;
use Faker\Generator as Faker;

$factory->define(Empleado::class, function (Faker $faker) {
    return [
        'puesto_id' => Puesto::inRandomOrder()->value('id') ?: factory(Puesto::class),
        'puesto_id' => 1,
        'codigo' => 1,
        'fecha_ingreso' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'nombre' => $faker->name,
        'apellido' => $faker->lastName,
        'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'dpi' => '1234',
        'direccion' => $faker->address,
        'telefono' => '1234',
        'email' => $faker->safeEmail,
        'estado' => 1
    ];
});