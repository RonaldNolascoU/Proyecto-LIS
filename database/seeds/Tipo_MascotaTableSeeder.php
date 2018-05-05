<?php

use Illuminate\Database\Seeder;
use App\TipoMascota;

class Tipo_MascotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = new TipoMascota();
        $tipo->NombreTipo = 'Perro';
        $tipo->save();

        $tipo = new TipoMascota();
        $tipo->NombreTipo = 'Gato';
        $tipo->save();

        $tipo = new TipoMascota();
        $tipo->NombreTipo = 'Ave';
        $tipo->save();
    }
}
