<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraTable extends Migration
{
    public function up()
{
    Schema::create('detalle_compra', function (Blueprint $table) {
        $table->id('id_detalle');
        $table->foreignId('id_compra')->constrained('compras')->onDelete('cascade');
        $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 10, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('detalle_compra');
}

}
