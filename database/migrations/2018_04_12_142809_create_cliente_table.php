<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('PrimerNombre');
            $table->string('SegundoNombre')->nullable();
            $table->string('PrimerApellido');
            $table->string('SegundoApellido')->nullable();
            $table->string('DUI');
            $table->string('NIT');
            $table->string('telefono');
            $table->string('correo');
            $table->text('clave');
            $table->timestamps();
            $table->unique('correo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
