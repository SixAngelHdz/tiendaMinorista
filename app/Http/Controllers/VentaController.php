<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Cliente;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda, si existe
        $query = $request->input('search');

        $clientes = Cliente::all();
        $carrito = Carrito::all();
            // Obtener los productos, filtrando por nombre o id si se proporciona un término de búsqueda
        $productos = Producto::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nombre', 'like', "%{$query}%")
                                 ->orWhere('id_producto', $query);
        })->paginate(10); // Paginando los resultados, 10 por página


        // Pasar los productos a la vista
        return view('ventas.index', compact('productos', 'query','clientes','carrito'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

   public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'productos.*.precio_unitario' => 'required|numeric|min:0.01',
    ]);

    // Si llegamos aquí, significa que la validación ha pasado
    $venta = Venta::create([
        'cliente_id' => $request->cliente_id,
        'fecha' => now(), // Usa la fecha actual o ajusta según tus necesidades
    ]);

    // Guardar detalles de la venta...
    foreach ($request->productos as $producto) {
        // Lógica para guardar detalles y actualizar el stock...
    }

    return response()->json(['success' => true, 'message' => 'Venta creada con éxito.']);
}


    public function carritoAdd(Request $request){
        
    }

    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        $detalles = $venta->detalleVentas;
        return view('ventas.show', compact('venta', 'detalles'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        // Aquí puedes agregar lógica para actualizar detalles de la venta si es necesario

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito');
    }

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $detalles = $venta->detalleVentas;

        // Restablecer el stock de los productos relacionados a esta venta
        foreach ($detalles as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad; // Aumentar el stock
            $producto->save();
        }

        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito');
    }
}
