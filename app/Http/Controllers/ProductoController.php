<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $categorias = Categoria::all(); // Obtener todas las categorías
    
        // Pasar productos y categorías a la vista
        return view('productos.index', compact('productos', 'categorias','proveedores'));
    }
    

  

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor', // Validar que el proveedor exista
        ]);
    
        Producto::create($request->all());
    
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito');
    }
    

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito');
    }
}
