<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTerminate extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'order_terminate';

    // Campos asignables en la tabla
    protected $fillable = [
        'order_id',
    ];
}
