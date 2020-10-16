<?php

use Illuminate\Database\Seeder;

use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'rol_id' => 1,
            'empleado_id' => 1,
            'fecha_registro' => Carbon::now(),
            'usuario' => 'milton-0001',
            'password' => bcrypt('milton-0001')
        ));

        User::create(array(
            'rol_id' => 1,
            'empleado_id' => 2,
            'fecha_registro' => Carbon::now(),
            'usuario' => 'maria-0002',
            'password' => bcrypt('maria-0002')
        ));

        User::create(array(
            'rol_id' => 2,
            'empleado_id' => 2,
            'fecha_registro' => Carbon::now(),
            'usuario' => 'secretaria-0003',
            'password' => bcrypt('secretaria-0003')
        ));

        User::create(array(
            'rol_id' => 3,
            'empleado_id' => 3,
            'fecha_registro' => Carbon::now(),
            'usuario' => 'enfermera-0004',
            'password' => bcrypt('enfermera-0004')
        ));


    }
}
