<?php

use App\Models\Puesto;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Puesto::create(array(
            'codigo' => 'PUESTO-0001',
            'nombre' => 'Administrador'
        ));
    }
}
