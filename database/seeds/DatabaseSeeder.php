<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartamentoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(TipoMovimientoSeeder::class);
        $this->call(CajaSeeder::class);
    }
}
