<?php

use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpleadoPuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Empleado::class, 20)->create();
    }
}
