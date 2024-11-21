<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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
                <span class="h4 ms-2">Clientes</span>
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

        <div class="d-flex mb-3">
            <input type="text" id="searchInput" class="form-control me-2" placeholder="Buscar cliente por nombre...">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClientModal">Agregar
                Cliente</button>
        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="clientTable">
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id_cliente }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>
                            <!-- Botones de Editar y Eliminar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editClientModal"
                                onclick="loadClientData({{ $cliente->id_cliente }})">Editar</button>
                            <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST"
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


    @include('clientes.create');
    @include('clientes.edit');




    <footer class="bg-primary text-white py-4 text-center">
        <div class="container">
            <p>&copy; 2024 Ferretería "AA". Todos los derechos reservados.</p>
            <p>
                <a href="#" class="text-white">Política de Privacidad</a> |
                <a href="#" class="text-white">Términos de Servicio</a>
            </p>
        </div>
    </footer>



    <!-- Bootstrap JS (Opcional, si necesitas algún componente JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para filtrar los clientes por nombre
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#clientTable tr');

            rows.forEach(function(row) {
                const clientName = row.cells[1].textContent.toLowerCase();
                if (clientName.includes(searchValue)) {
                    row.style.display = ''; // Mostrar fila
                } else {
                    row.style.display = 'none'; // Ocultar fila
                }
            });
        });

        function loadClientData(clientId) {
            // Aquí puedes hacer una llamada AJAX para obtener los datos del cliente
            const clientes = @json($clientes); // Reemplazar con los datos adecuados

            const cliente = clientes.find(c => c.id_cliente === clientId); // Encuentra el cliente por ID

            // Establece la URL de acción del formulario
            document.getElementById('editClientForm').action = "/clientes/" + clientId; // Cambia esto si es necesario
            document.getElementById('editClientId').value = clientId;
            document.getElementById('editNombre').value = cliente.nombre;
            document.getElementById('editEmail').value = cliente.email;
            document.getElementById('editTelefono').value = cliente.telefono;
            document.getElementById('editDireccion').value = cliente.direccion;
        }
    </script>

</body>

</html>
