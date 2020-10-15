<?php

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create(array(
            'codigo' => 'ÁREA-0001',
            'nombre' => 'Administración'
        ));
    }
}
