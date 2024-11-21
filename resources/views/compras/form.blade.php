<div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarProductoModalLabel">Ingresar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('compras.store') }}" method="POST" id="formAgregarProducto">
                    @csrf
                    <div class="mb-3">
                        <label for="nombreProducto" class="form-label">Producto</label>
                        <input type="text" name="name" class="form-control" id="nombreProducto" value="Nombre Producto" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="precioProducto" class="form-label">Precio</label>
                        <!-- Usar readonly en lugar de disabled para que se envíe el valor -->
                        <input type="text" class="form-control" id="precioProducto" value="100" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="cantidadProducto" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidadProducto" name="qty">
                    </div>
                    <!-- Campo oculto para el ID del producto y el cliente -->
                    <input type="hidden" id="idProducto" name="product_id" value="1">
                    <input type="hidden" id="subtotalProducto" name="subtotal" value="100">
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
