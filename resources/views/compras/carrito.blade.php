<div class="table-responsive" id="tablaProductosAgregados">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="productosSeleccionados">
            @foreach ($carrito as $producto)
                <tr>
                    <td>{{ $producto->product_id }}</td>
                    <td>{{ $producto->name }}</td>
                    <td>{{ $producto->qty }}</td>
                    <td>${{ $producto->subtotal }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm"
                            onclick="abrirModalEliminar('{{ $producto->id }}', 
                                '{{ $producto->name }}', 
                                '{{ $producto->qty }}', 
                                '{{ $producto->subtotal}}')"
                            data-bs-toggle="modal" data-bs-target="#eliminarProductoModal">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
