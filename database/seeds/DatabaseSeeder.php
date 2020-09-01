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
        $this->call(UserSeeder::class);
        $this->call(ExampleSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(TipoProductoSeeder::class);
    }
}
