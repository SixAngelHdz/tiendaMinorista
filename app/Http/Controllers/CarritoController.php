<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente', // Asegúrate de usar el nombre correcto de la columna
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);


        // Crear una nueva entrada en la tabla carrito
        $carrito = new Carrito();
        $carrito->id_cliente = $request->id_cliente;
        $carrito->id_producto = $request->id_producto;
        $carrito->cantidad = $request->cantidad;
        $carrito->precio = $request->precio;
        $subt = $request->cantidad  *  $request->precio;
        $carrito->subtotal = $subt;
        $carrito->save();

        // Redirigir de vuelta a la página anterior
        return back()->with('success', 'Producto agregado al carrito.');
    }
    public function eliminarProducto($id)
    {
        $producto = Carrito::findOrFail($id);
        $producto->delete();


        return back()->with('success', 'Producto eliminado del carrito.');
    }


    public function proceedToPayment()
    {

        // Obtener todos los items del carrito del cliente
        $carritoItems = Carrito::all();

        // Iniciar una transacción para garantizar que las operaciones sean atómicas
        DB::beginTransaction();

        try {
            // Variable para el precio total
            $totalPrice = 0;

            // Decrementar el stock de productos y calcular el precio total
            foreach ($carritoItems as $item) {
                $producto = Producto::find($item->id_producto);

                // Verificar si hay suficiente stock
                if ($producto->stock >= $item->cantidad) {
                    // Decrementar el stock del producto
                    $producto->stock -= $item->cantidad;
                    $producto->save();

                    // Calcular el total del carrito (se asume que el subtotal ya está calculado)
                    $totalPrice += $item->subtotal;
                } else {
                    // Si no hay suficiente stock, lanzar un error
                    return redirect()->back()->with('error', 'No hay suficiente stock para el producto ' . $producto->name);
                }
            }

            // Registrar la venta en la tabla venta

            $clientes = DB::table('carrito')->distinct()->pluck('id_cliente');

            foreach ($clientes as  $value) {
                $carritoCliente = Carrito::where('id_cliente', $value);
                $total = 0;

                foreach ($carritoCliente as $item) {
                    $total = $total + $item->subtotal;
                }
                $venta = DB::table('ventas')->insertGetId([
                    'id_cliente' => $value,
                    'total' => $total,
                ]);
                
                foreach ($carritoCliente as $item) {
                    DB::table('detalle_venta')->insert([
                        'id_venta' => $venta,
                        'id_producto' => $item->id_producto,
                        'cantidad'=>$item->cantidad,
                        'precio_unitario'=> $item->precio
                    ]);
                }

                Carrito::where('id_cliente', $value)->delete();
            }




            // Eliminar los productos del carrito después de procesar el pago

            // Confirmar la transacción
            DB::commit();

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->back()->with('success', 'Pago procesado correctamente. Gracias por tu compra!');
        } catch (\Exception $e) {
            // Si algo falla, revertir la transacción
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar el pago: ' . $e->getMessage());
        }
    }
}
