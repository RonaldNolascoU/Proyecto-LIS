<?php

use Illuminate\Database\Seeder;
use App\TipoMedicamento;

class Tipo_MedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = new TIpoMedicamento();
        $tipo->TipoMedicamento = "Inyeccion";
        $tipo->Estado = 1;
        $tipo->save();

        $tipo = new TIpoMedicamento();
        $tipo->TipoMedicamento = "Tableta";
        $tipo->Estado = 1;
        $tipo->save();

        $tipo = new TIpoMedicamento();
        $tipo->TipoMedicamento = "Polvo soluble";
        $tipo->Estado = 1;
        $tipo->save();

        $tipo = new TIpoMedicamento();
        $tipo->TipoMedicamento = "Jarabe";
        $tipo->Estado = 1;
        $tipo->save();

        $tipo = new TIpoMedicamento();
        $tipo->TipoMedicamento = "Premix";
        $tipo->Estado = 1;
        $tipo->save();
    }
}
