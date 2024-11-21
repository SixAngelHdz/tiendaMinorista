<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentaTable extends Migration
{
    public function up()
{
    Schema::create('detalle_venta', function (Blueprint $table) {
        $table->id('id_detalle');
        $table->foreignId('id_venta')->constrained('ventas')->onDelete('cascade');
        $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 10, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('detalle_venta');
}

}
