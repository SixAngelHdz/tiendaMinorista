<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-lg {
            max-width: 90%;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 576px) {

            h1,
            h3 {
                font-size: 1.5rem;
            }

            .btn {
                font-size: 0.875rem;
            }
        }

        .btn-custom {
            min-width: 120px;
        }
    </style>
</head>

<body>
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <span class="h4 ms-2">Ferretería "AA"</span>
            </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="/" class="nav-link text-white">Inicio</a></li>
                    <li class="nav-item"><a href="{{ route('productos.index') }}"
                            class="nav-link text-white">Productos</a></li>
                    <li class="nav-item"><a href="{{ route('proveedores.index') }}"
                            class="nav-link text-white">Proveedores</a></li>
                    <li class="nav-item"><a href="{{ route('clientes.index') }}"
                            class="nav-link text-white">Clientes</a></li>
                    <li class="nav-item"><a href="{{ route('compras.index') }}" class="nav-link text-white">Compras</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('ventas.index') }}" class="nav-link text-white">Ventas</a>
                    </li>
                    <li class="nav-item"><a href="{{route('ordenes.index');}}" class="nav-link text-white">Ordenes</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Punto de Venta</h1>

        <!-- Selección de Cliente -->
        <div class="mb-3">
            <label for="clienteSelect" class="form-label">Seleccionar Cliente</label>
            <select class="form-select" id="clienteSelect">
                <option value="" selected disabled>Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para abrir la ventana emergente -->
        <div class="d-grid gap-2 d-md-block mb-3">
            <button class="btn btn-primary btn-custom" data-bs-toggle="modal"
                data-bs-target="#seleccionarProductoModal">
                Seleccionar Producto
            </button>
        </div>

        @include('ventas.productos')
        @include('ventas.form')
        @include('ventas.delete')

        <!-- Tabla de Productos Agregados -->
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
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->producto->nombre }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>${{ $producto->subtotal }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm"
                                    onclick="abrirModalEliminar('{{ $producto->id }}', 
                                        '{{ $producto->producto->nombre }}', 
                                        '{{ $producto->cantidad }}', 
                                        '{{ $producto->subtotal }}')"
                                    data-bs-toggle="modal" data-bs-target="#eliminarProductoModal">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- Total y Confirmación -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h3>Total: $<span id="totalVenta">0.00</span></h3>
            <form action="{{ route('carrito.proceedToPayment') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-custom" id="confirmarVenta">Confirmar Venta</button>
            </form>
        </div>



    </div>

    <footer class="bg-primary text-white py-4 text-center mt-4">
        <div class="container">
            <p>&copy; 2024 Ferretería "AA". Todos los derechos reservados.</p>
            <p>
                <a href="#" class="text-white">Política de Privacidad</a> |
                <a href="#" class="text-white">Términos de Servicio</a>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar la tabla de productos cuando se haga clic en el botón

        // Filtrar los productos en el modal de selección
        const searchInput = document.getElementById('buscarProductoModal');
        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#productosDisponibles tr');
            rows.forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const price = row.cells[1].textContent.toLowerCase();
                if (name.includes(filter) || price.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Función para llenar el modal con la información del producto seleccionado
        function setProducto(idProducto, nombre, precio, stock) {
            const clienteSelect = document.getElementById('clienteSelect');
            const idCliente = clienteSelect.value;
            console.log(idCliente);
            document.getElementById('nombreProducto').value = nombre;
            document.getElementById('cantidadProducto').value = 1;
            document.getElementById('cantidadProducto').min = 1;
            document.getElementById('cantidadProducto').max = stock;
            document.getElementById('precioProducto').value = precio;
            document.getElementById('idProducto').value = idProducto;
            document.getElementById('idCliente').value = idCliente;

            var subtotal = 1 * precio;
            document.getElementById('subtotalProducto').value = subtotal;

        }


        // Función para recalcular el subtotal cada vez que se cambie la cantidad
        document.getElementById('cantidadProducto').addEventListener('input', function() {
            const cantidad = parseInt(this.value);
            const precio = parseFloat(document.getElementById('precioProducto').value);

            // Verificar si la cantidad y el precio son válidos
            if (!isNaN(cantidad) && !isNaN(precio)) {
                const subtotal = cantidad * precio;

                // Actualizar el campo oculto de subtotal
                document.getElementById('subtotalProducto').value = subtotal.toFixed(2);
            }
        });


        document.getElementById('formAgregarProducto').addEventListener('submit', function(e) {
            // Prevenir el envío del formulario si no todos los campos están completos
            e.preventDefault();

            // Obtener los valores de los campos
            const nombreProducto = document.getElementById('nombreProducto').value;
            const precioProducto = document.getElementById('precioProducto').value;
            const cantidadProducto = document.getElementById('cantidadProducto').value;
            const idProducto = document.getElementById('idProducto').value;
            const idCliente = document.getElementById('idCliente').value;
            const subtotalProducto = document.getElementById('subtotalProducto').value;

            // Validar que los campos no estén vacíos o sean inválidos
            if (!nombreProducto || !precioProducto || !cantidadProducto || !idProducto || !idCliente || !
                subtotalProducto) {
                // Mostrar el modal con el mensaje de error
                document.getElementById('mensajeErrorTexto').textContent =
                    'Por favor, complete todos los campos antes de agregar al carrito.';
                const errorModal = new bootstrap.Modal(document.getElementById('mensajeErrorModal'));
                errorModal.show();
                return;
            }

            // Si todos los campos son válidos, enviar el formulario
            this.submit();
        });

        function abrirModalEliminar(id, nombre, cantidad, subtotal) {
            // Rellenar el modal con la información del producto
            document.getElementById('productoNombre').textContent = nombre;
            document.getElementById('productoCantidad').textContent = cantidad;
            document.getElementById('productoSubtotal').textContent = subtotal;

            // Configurar la acción del formulario para eliminar el producto
            const form = document.getElementById('formEliminarProducto');
            form.action = `/carrito/producto/${id}`; // Cambia el ID dinámicamente
        }
    </script>

</body>

</html>
