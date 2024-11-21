<!-- Modal para Confirmar Eliminación -->
<div class="modal fade" id="eliminarProductoModal" tabindex="-1" aria-labelledby="eliminarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarProductoModalLabel">Eliminar Producto del Carrito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este producto del carrito?</p>
                <ul>
                    <li><strong>Producto:</strong> <span id="productoNombre"></span></li>
                    <li><strong>Cantidad:</strong> <span id="productoCantidad"></span></li>
                    <li><strong>Subtotal:</strong> $<span id="productoSubtotal"></span></li>
                </ul>
                <!-- Formulario para eliminar el producto -->
                <form id="formEliminarProducto" method="POST">
                    @csrf
                    @method('DELETE') <!-- Indica el método DELETE -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" form="formEliminarProducto">Eliminar</button>
            </div>
        </div>
    </div>
</div>
