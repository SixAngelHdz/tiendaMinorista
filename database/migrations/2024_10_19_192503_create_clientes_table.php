<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
{
    Schema::create('clientes', function (Blueprint $table) {
        $table->id('id_cliente');
        $table->string('nombre', 100);
        $table->string('email', 100)->nullable();
        $table->string('telefono', 15)->nullable();
        $table->string('direccion', 255)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('clientes');
}

}
