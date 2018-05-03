<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NombreMedicamento', 30);
            $table->string('Medida', 100);
            $table->unsignedInteger('diagnostico_id');
            $table->unsignedInteger('tipo_medicamento_id');
            $table->foreign('diagnostico_id')->references('id')->on('diagnosticos')->onDelete('cascade');
            $table->foreign('tipo_medicamento_id')->references('id')->on('tipo_medicamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}
