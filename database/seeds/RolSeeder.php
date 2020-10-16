<?php

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create(array(
            'nombre' => 'Administrador'
        ));

        Rol::create(array(
            'nombre' => 'Secretaria'
        ));

        Rol::create(array(
            'nombre' => 'Enfermera'
        ));
    }
}
