<?php

use Illuminate\Database\Seeder;
use App\Models\TipoMovimiento;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoMovimiento::create(array(
            'codigo' => 'MOVIMIENTO-0001',
            'nombre' => 'Compra',
            'entrada' => 0,
            'salida' => 1,
            'estado' => 1
        ));
    }
}
