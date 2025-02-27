<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_proveedor');
    }
}
