  <!-- Modal para seleccionar productos -->
  <div class="modal fade" id="seleccionarProductoModal" tabindex="-1" aria-labelledby="seleccionarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seleccionarProductoModalLabel">Seleccionar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Campo de búsqueda en el modal -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="buscarProductoModal" placeholder="Buscar producto por nombre o precio">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="productosDisponibles">
                            @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre }}</td>
                                <td>${{ $producto->precio }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#agregarProductoModal" 
                                            onclick="setProducto('{{ $producto->id_producto }}', '{{ $producto->nombre }}', {{ $producto->precio }}, {{ $producto->stock }})">
                                        Agregar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>