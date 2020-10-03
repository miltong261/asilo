<?php

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->delete();
        $jsonFile = File::get("database/json/departamentos.json");
        $data = json_decode($jsonFile);
        foreach ($data as $object) {
            Departamento::create(array(
                'id' => $object->id,
                'nombre' => $object->nombre,
            ));
        }
    }
}
