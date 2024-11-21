<!-- Modal para Editar Producto -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNombreProducto" class="form-label">Nombre</label>
                        <input type="text" id="editNombreProducto" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescripcionProducto" class="form-label">Descripción</label>
                        <textarea id="editDescripcionProducto" name="descripcion" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPrecioProducto" class="form-label">Precio Unitario</label>
                        <input type="number" id="editPrecioProducto" name="precio" class="form-control" required step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="editStockProducto" class="form-label">Stock</label>
                        <input type="number" id="editStockProducto" name="stock" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>
