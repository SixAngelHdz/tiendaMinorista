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
                    <li class="nav-item"><a href="{{route('productos.index');}}" class="nav-link text-white">Productos</a></li>
                    <li class="nav-item"><a href="{{route('proveedores.index');}}" class="nav-link text-white">Proveedores</a></li>
                    <li class="nav-item"><a href="{{route('clientes.index');}}" class="nav-link text-white">Clientes</a></li>
                    <li class="nav-item"><a href="/" class="nav-link text-white">Compras</a></li>
                    <li class="nav-item"><a href="/" class="nav-link text-white">Ventas</a></li>
                </ul>
            </nav>
        </div>
    </header>


