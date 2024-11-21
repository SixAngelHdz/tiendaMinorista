<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            color: #343a40;
        }

        .table th {
            background-color: #6c757d;
            color: white;
        }

        .btn {
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>



    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <span class="h4 ms-2">Productos</span>
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
                    <li class="nav-item"><a href="{{route('compras.index');}}" class="nav-link text-white">Compras</a></li>
                    <li class="nav-item"><a href="{{route('ventas.index');}}" class="nav-link text-white">Ventas</a></li>
                    <li class="nav-item"><a href="{{route('ordenes.index');}}" class="nav-link text-white">Ordenes</a></li>
                </ul>
            </nav>
        </div>
    </header>




    <div class="container mt-5">

        <!-- Campo de búsqueda y botón de crear producto -->
        <div class="row mb-3">
            <div class="col-md-10">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar producto por nombre...">
            </div>
            <div class="col-md-2 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">Crear
                    Producto</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id_producto }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>{{ $producto->stock }}</td>
                            
                            <td>{{ $producto->categoria ? $producto->categoria->nombre : 'No disponible' }}</td>
                            <td>{{ $producto->proveedor ? $producto->proveedor->nombre : 'No disponible' }}</td>
                            
                            <td>
                                <!-- Botones de Editar y Eliminar -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal"
                                    onclick="loadProductData({{ $producto->id_producto }})">Editar</button>
                                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('productos.create')
    @include('productos.edit')



    <footer class="bg-primary text-white py-4 text-center">
        <div class="container">
            <p>&copy; 2024 Ferretería "AA". Todos los derechos reservados.</p>
            <p>
                <a href="#" class="text-white">Política de Privacidad</a> |
                <a href="#" class="text-white">Términos de Servicio</a>
            </p>
        </div>
    </footer>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript para el filtro -->
    <script>
        // Función para filtrar los productos por nombre
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#productTable tr');

            rows.forEach(function(row) {
                const productName = row.cells[1].textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    row.style.display = ''; // Mostrar fila
                } else {
                    row.style.display = 'none'; // Ocultar fila
                }
            });
        });

        function loadProductData(productId) {
            const producto = @json($productos);
            const product = producto.find(p => p.id_producto === productId);
            const form = document.getElementById('editProductForm');
            form.action = "{{ url('productos') }}/" + productId; // Esta línea debe funcionar correctamente


            console.log(form.action); // Agrega esta línea para verificar la URL

            // Rellena los campos del formulario de edición
            document.getElementById('editNombreProducto').value = product.nombre;
            document.getElementById('editDescripcionProducto').value = product.descripcion;
            document.getElementById('editPrecioProducto').value = product.precio;
            document.getElementById('editStockProducto').value = product.stock;
        }
    </script>
</body>

</html>
