<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
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
                <span class="h4 ms-2">Pedidos</span>
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
                    <li class="nav-item"><a href="{{route('ordenes.index');}}" class="nav-link text-white">Pedidos</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="text-center my-4">Lista de Pedidos</h1>

        @if (isset($error))
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @else
            @foreach ($ordenes as $pedido)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Pedido ID: {{ $pedido['order_id'] }} - Estado: {{ ucfirst($pedido['status']) }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Usuario: {{ $pedido['userx'] }}</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedido['items'] as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['qty'] }}</td>
                                        <td>${{ number_format($item['price'], 2) }}</td>
                                        <td>${{ number_format($item['qty'] * $item['price'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($pedido['status'] != 'pending')
                            <form action="{{ route('pedidos.confirmar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pedido" value="{{ json_encode($pedido) }}">
                                <button type="submit" class="btn btn-success">Confirmar Pedido</button>
                            </form>
                        @endif
                        <!-- Enviar el objeto pedido completo como JSON -->

                    </div>
                </div>
            @endforeach
        @endif
    </div>

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

</body>

</html>
