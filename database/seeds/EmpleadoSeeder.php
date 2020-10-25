<?php

use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::create(array(
            'area_id' => 1,
            'puesto_id' => 1,
            'codigo' => 'EMPLEADO-0001',
            'fecha_ingreso' => '2020-08-12',
            'fecha_registro' => '2020-08-12',
            'nombre' => 'Milton Alberto',
            'apellido' => 'Girón López',
            'fecha_nacimiento' => '1997-01-26',
            'dpi' => 3280115171101,
            'direccion' => 'Colonia el Maestro, Retalhuleu',
            'telefono' => 41802654
        ));
    }
}
