<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoItem extends Model
{

    use HasFactory;

    protected $table = 'table_carritocompra';

    // Indica los campos que se pueden asignar masivamente
    protected $fillable = [
        'product_id',
        'name',
        'qty',
        'subtotal',
    ];
}
