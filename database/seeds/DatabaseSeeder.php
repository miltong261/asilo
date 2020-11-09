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
        $this->call(UnidadMedidaSeeder::class);
        $this->call(TipoProductoSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(TipoMovimientoSeeder::class);
        $this->call(CajaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
    }
}
