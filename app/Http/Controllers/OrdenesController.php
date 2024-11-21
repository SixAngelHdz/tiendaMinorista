<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrdenesController extends Controller
{
    public function index()
    {

        // URL del servidor destino
        $url = 'https://elmayoreo-back-production.up.railway.app/requests/angel'; // Cambia la URL si es diferente
        // URL del servidor destino
        $urlPrdo = 'https://elmayoreo-back-production.up.railway.app/products'; // Cambia la URL si es diferente


        try {
            // Obtener los `order_id` de la tabla `order_terminate`
            $terminatedOrderIds = DB::table('order_terminate')->pluck('order_id')->toArray();

            // Configurar el cliente HTTP para manejar SSL
            $httpClient = Http::withoutVerifying(); // Omitir verificación del certificado SSL (útil para pruebas)

            // Hacer la solicitud a la API de pedidos
            $response = $httpClient->get($url);
            if ($response->failed()) {
                throw new \Exception('Error al obtener los pedidos.');
            }
            $pedidos = $response->json();

            // Hacer la solicitud a la API de productos
            $productResponse = $httpClient->get($urlPrdo);
            if ($productResponse->failed()) {
                throw new \Exception('Error al obtener los productos.');
            }
            $products = $productResponse->json();

            // Filtrar los pedidos que no estén en la lista de terminados
            $filteredPedidos = collect($pedidos)->filter(function ($pedido) use ($terminatedOrderIds) {
                return !in_array($pedido['order_id'], $terminatedOrderIds);
            });

            // Para cada pedido, agregar el nombre y precio de los productos
            $ordenes = $filteredPedidos->map(function ($pedido) use ($products) {
                $pedido['items'] = collect($pedido['items'])->map(function ($item) use ($products) {
                    $product = collect($products)->firstWhere('id', $item['product_id']);
                    if ($product) {
                        $item['name'] = $product['name'];
                        $item['price'] = $product['wholesale_price']; // Cambiar a unit_price si prefieres
                    }
                    return $item;
                })->toArray();
                return $pedido;
            });



            return view('ordenes.index', compact('ordenes'));

            return response()->json($pedidosConDetalles);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function confirmar(Request $request)
    {
        // Recuperar el objeto 'pedido' enviado por el formulario
        $pedido = json_decode($request->input('pedido'), true);

        // Ahora puedes acceder a los valores del pedido como un array
        $order_id = $pedido['order_id'];
        $status = $pedido['status'];
        $user = $pedido['userx'];
        $items = $pedido['items'];


        // Verifica si los items del pedido son un array
        if (is_array($items)) {
            DB::beginTransaction(); // Inicia una transacción para manejar la base de datos

            $total = 0;
            try {
                foreach ($items as $item) {
                    $productoId = $item['product_id'];
                    $productoNombre = $item['name'];
                    $cantidadSolicitada = $item['qty'];
                    $productoPrecio = $item['price'];

                    $total = $total + ($productoPrecio * $cantidadSolicitada);

                    //SELECT `id_producto`, `nombre`, `precio`, `stock` FROM `` WHERE 1
                    // Verifica si el producto existe en la base de datos
                    $producto = DB::table('productos')->where('id_producto', $productoId)->first();

                    if ($producto) {
                        // Si el producto existe, actualiza el stock
                        DB::table('productos')
                            ->where('id_producto', $productoId)
                            ->update(['stock' => DB::raw('stock + ' . $cantidadSolicitada)]);
                    } else {
                        // Si el producto no existe, lo crea
                        $productCost = $productoPrecio + 20;
                        DB::table('productos')->insert([
                            'id_producto' => $productoId,
                            'nombre' => $productoNombre,
                            'precio' => $productoPrecio,
                            'id_proveedor' => 1,
                            'stock' => $cantidadSolicitada
                        ]);
                    }
                }
                $idCompra = DB::table('compras')->insertGetId([
                    'id_proveedor' => 1,
                    'total' => $total,
                ]);

                foreach ($items as $item) {
                    $productoId = $item['product_id'];
                    $productoNombre = $item['name'];
                    $cantidadSolicitada = $item['qty'];
                    $productoPrecio = $item['price'];


                    DB::table('detalle_compra')->insert([
                        'id_compra' => $idCompra,
                        'id_producto' => $productoId,
                        'cantidad' => $cantidadSolicitada,
                        'precio_unitario' => $productoPrecio,
                    ]);
                }

                // Registra el movimiento de terminación de pedido
                DB::table('order_terminate')->insert([
                    'order_id' => $order_id
                ]);

                DB::commit(); // Si todo sale bien, confirma la transacción
                return redirect()->route('ordenes.index')->with('success', 'Pedido confirmado correctamente.');
            } catch (\Exception $e) {
                DB::rollBack(); // Si algo falla, deshace la transacción
                // Loguear el error o manejarlo según sea necesario
                return response()->json(['error' => 'Ocurrió un error al procesar el pedido: ' . $e->getMessage()], 500);
            }
        } else {
            // Si no es un array, maneja el error o el flujo según sea necesario
            return response()->json(['error' => 'El campo "items" no es un array.'], 400);
        }




        // Realiza cualquier acción necesaria, como actualizar el estado del pedido en la base de datos

        // Ejemplo de actualización de estado:

        // Redirigir con un mensaje de éxito
    }
}
