<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('PrimerNombre', 15);
            $table->string('SegundoNombre', 15)->nullable();
            $table->string('PrimerApellido', 15);
            $table->string('SegundoApellido', 15)->nullable();
            $table->string('DUI',10);
            $table->string('NIT',15);
            $table->string('telefono',9);
            $table->string('correo',50)->unique();
            $table->text('imagen');
            $table->text('clave');
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
        Schema::dropIfExists('clientes');
    }
}
