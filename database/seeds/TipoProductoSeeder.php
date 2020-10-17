<?php

use App\Models\TipoProducto;
use Illuminate\Database\Seeder;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoProducto::create(array(
            'codigo' => 'CATEGORIA-0001',
            'nombre' => 'Medicina',
            'medicamento' => 1,
            'producto' => 0
        ));

        TipoProducto::create(array(
            'codigo' => 'CATEGORIA-0002',
            'nombre' => 'Utensilios médicos',
            'medicamento' => 1,
            'producto' => 0
        ));

        TipoProducto::create(array(
            'codigo' => 'CATEGORIA-0003',
            'nombre' => 'Perecedero',
            'medicamento' => 0,
            'producto' => 1
        ));

        TipoProducto::create(array(
            'codigo' => 'CATEGORIA-0004',
            'nombre' => 'No perecedero',
            'medicamento' => 0,
            'producto' => 1
        ));
    }
}
