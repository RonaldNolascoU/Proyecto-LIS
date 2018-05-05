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
        $tipo->Estado = 1;
        $tipo->save();

        $tipo = new TipoMascota();
        $tipo->NombreTipo = 'Gato';
        $tipo->Estado = 1;
        $tipo->save();

        $tipo = new TipoMascota();
        $tipo->NombreTipo = 'Ave';
        $tipo->Estado = 1;
        $tipo->save();
    }
}
