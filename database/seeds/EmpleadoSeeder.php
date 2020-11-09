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
            'nombre' => 'Administrador',
            'apellido' => 'Administrador',
            'fecha_nacimiento' => '1970-01-01',
            'dpi' => 1111111111111,
            'direccion' => 'Retalhuleu, Retalhuleu',
            'telefono' => 40405050
        ));
    }
}
