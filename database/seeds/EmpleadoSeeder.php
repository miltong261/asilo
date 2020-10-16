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
            'nombre' => 'Milton Alberto',
            'apellido' => 'Girón López',
            'fecha_nacimiento' => '1997-01-26',
            'dpi' => 3280115171101,
            'direccion' => 'Colonia el Maestro, Retalhuleu',
            'telefono' => 41802654
        ));

        Empleado::create(array(
            'area_id' => 1,
            'puesto_id' => 2,
            'codigo' => 'EMPLEADO-0002',
            'fecha_ingreso' => '2020-08-12',
            'nombre' => 'Maria',
            'apellido' => 'Werner',
            'fecha_nacimiento' => '1996-11-10',
            'dpi' => 3281315172101,
            'direccion' => 'San Francisco Zapotitlan',
            'telefono' => 54232407
        ));

        Empleado::create(array(
            'area_id' => 1,
            'puesto_id' => 3,
            'codigo' => 'EMPLEADO-0003',
            'fecha_ingreso' => '2020-08-12',
            'nombre' => 'Secretaria',
            'apellido' => 'Secretaria',
            'fecha_nacimiento' => '1970-10-20',
            'dpi' => 1234567891234,
            'direccion' => 'Mazatenango, Suchitepequez',
            'telefono' => 12345678
        ));

        Empleado::create(array(
            'area_id' => 2,
            'puesto_id' => 2,
            'codigo' => 'EMPLEADO-0004',
            'fecha_ingreso' => '2020-08-12',
            'nombre' => 'Enfermera',
            'apellido' => 'Enfermera',
            'fecha_nacimiento' => '1970-10-20',
            'dpi' => 1234567894321,
            'direccion' => 'Retalhuleu, Retalhuleu',
            'telefono' => 87654321
        ));
    }
}
