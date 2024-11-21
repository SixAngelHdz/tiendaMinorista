<div class="modal fade" id="addProviderModal" tabindex="-1" aria-labelledby="addProviderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProviderModalLabel">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProviderForm" action="{{ route('proveedores.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="addNombre" class="form-label">Nombre</label>
                        <input type="text" id="addNombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" id="addEmail" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTelefono" class="form-label">Teléfono</label>
                        <input type="text" id="addTelefono" name="telefono" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDireccion" class="form-label">Dirección</label>
                        <input type="text" id="addDireccion" name="direccion" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar Proveedor</button>
                </form>
            </div>
        </div>
    </div>
</div>
