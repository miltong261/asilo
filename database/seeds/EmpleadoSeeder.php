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
            'nombre' => 'Angel Rubén',
            'apellido' => 'Ajanel Juárez',
            'fecha_nacimiento' => '1999-04-23',
            'dpi' => 3282227631101,
            'direccion' => 'Barrio San Luis Retalhuleu',
            'telefono' => 42243720
        ));
    }
}
