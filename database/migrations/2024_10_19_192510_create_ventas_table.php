<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
{
    Schema::create('ventas', function (Blueprint $table) {
        $table->id('id_venta');
        $table->foreignId('id_cliente')->constrained('clientes')->onDelete('set null');
        $table->dateTime('fecha_venta');
        $table->decimal('total', 10, 2);
        $table->string('metodo_pago', 50)->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('ventas');
}

}
