<?php

use App\Models\UnidadMedida;
use Illuminate\Database\Seeder;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoProducto::create(array(
            'codigo' => 'U_MEDIDA-0001',
            'nombre' => 'Unidad',
            'medicamento' => 1,
            'producto' => 1
        ));
    }
}
