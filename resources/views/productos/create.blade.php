<!-- Modal para Crear Producto -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Crear Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombreProducto" class="form-label">Nombre</label>
                        <input type="text" id="nombreProducto" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionProducto" class="form-label">Descripción</label>
                        <textarea id="descripcionProducto" name="descripcion" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precioProducto" class="form-label">Precio Unitario</label>
                        <input type="number" id="precioProducto" name="precio" class="form-control" required step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="stockProducto" class="form-label">Stock</label>
                        <input type="number" id="stockProducto" name="stock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoriaProducto" class="form-label">Categoría</label>
                        <select id="categoriaProducto" name="id_categoria" class="form-select" required>
                            <option value="">Seleccionar categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria}}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="proveedorProducto" class="form-label">Proveedor</label>
                        <select id="proveedorProducto" name="id_proveedor" class="form-select" required>
                            <option value="">Seleccionar proveedor</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor}}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>
