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
            'password' => bcrypt('asilo')
        ));
    }
}
