<?php

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->delete();
        $jsonFile = File::get("database/json/municipios.json");
        $data = json_decode($jsonFile);
        foreach ($data as $object) {
            Municipio::create(array(
                'departamento_id' => $object->departamento_id,
                'nombre' => $object->nombre,
            ));
        }
    }
}
