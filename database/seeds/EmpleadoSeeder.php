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
            'nombre' => 'Israel',
            'apellido' => 'Gómez',
            'fecha_nacimiento' => '1964-08-12',
            'dpi' => 1234567896523,
            'direccion' => 'Retalhuleu, Retalhuleu',
            'telefono' => 12345678
        ));
    }
}
