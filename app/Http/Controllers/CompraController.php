<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompraController extends Controller
{
    public function index()
    {

        // URL del servidor destino
        $url = 'https://elmayoreo-back-production.up.railway.app/products'; // Cambia la URL si es diferente

        // Realizar la solicitud GET al servidor protegido
        $response = Http::withOptions([
        'verify' => false, // Deshabilita la verificación del certificado SSL
        ])->get('https://elmayoreo-back-production.up.railway.app/products');

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {

            $productos = $response->json();
        }

        $carrito = CarritoItem::all();

        return view('compras.index', compact('productos', 'carrito'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|max:255',
            'name' => 'required|max:255',
            'qty' => 'required|numeric',
            'subtotal' => 'required', // Validar que el proveedor exista
        ]);

        CarritoItem::create($request->all());

        return redirect()->back()->with('success', 'Carrito creado con éxito');
    }

    public function create() {}

    public function destroy($id)
    {
        $carrito = CarritoItem::findOrFail($id);
        $carrito->delete();
        return redirect()->back()->with('success', 'Articulo eliminado con éxito');
    }


    public function sendRequest()
    {
        $carrito = CarritoItem::all();

        $datos = [
            'products' => $carrito->toArray(), // Convierte la colección a un arreglo
            'user' => 'angel',
        ];


        $url = 'https://elmayoreo-back-production.up.railway.app/request/';

        // Enviar datos con POST
        //$response = Http::post($url, $datos);
        $response = Http::withOptions([
            'verify' => false, // Deshabilita la verificación del certificado SSL
        ])->post($url, $datos);

        CarritoItem::truncate();
        // Manejar la respuesta
        if ($response->successful()) {
        
                return redirect()->back()->with('success', 'Solicitud realizada con éxito');
            
        }else{
            return response()->json([
                'mensaje' => 'Error al enviar solicitud',
                'respuesta' => $response->json(),
            ]);
        }

    }
}
