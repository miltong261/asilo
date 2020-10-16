<?php

use Illuminate\Database\Seeder;
use App\Models\Caja;

class CajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Caja::create(array(
            'nombre' => 'Administración',
            'saldo' => 5000
        ));
    }
}
