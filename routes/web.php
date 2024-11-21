<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\OrdenesController;

Route::resource('productos', ProductoController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('ventas', VentaController::class);
Route::resource('compras', CompraController::class);
Route::resource('ordenes', OrdenesController::class);


Route::post('/pedidos/confirmar/', [OrdenesController::class, 'confirmar'])->name('pedidos.confirmar');
Route::post('/compras/sendrequest', [CompraController::class, 'sendRequest'])->name('compras.sendRequest');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::delete('/carrito/producto/{id}', [CarritoController::class, 'eliminarProducto']);
Route::post('/carrito/proceed-to-payment', [CarritoController::class, 'proceedToPayment'])->name('carrito.proceedToPayment');


Route::get('/', function () {
    return view('welcome');
});
