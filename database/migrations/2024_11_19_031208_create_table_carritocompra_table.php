<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCarritocompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_carritocompra', function (Blueprint $table) {
            $table->id(); // Llave primaria autoincremental
            $table->unsignedBigInteger('product_id'); // Llave foránea al producto
            $table->string('name'); // Nombre del producto
            $table->integer('qty'); // Cantidad
            $table->decimal('subtotal', 10, 2); // Subtotal con dos decimales
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_carritocompra');
    }
}
