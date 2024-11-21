<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferretería "AA"</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            background: url('fondo-hero.jpg') no-repeat center center / cover;
            color: white;
        }

        .features .icon {
            background: #f8f9fa;
            border-radius: 50%;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
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
                    <li class="nav-item"><a href="{{route('productos.index');}}" class="nav-link text-white">Productos</a></li>
                    <li class="nav-item"><a href="{{route('proveedores.index');}}" class="nav-link text-white">Proveedores</a></li>
                    <li class="nav-item"><a href="{{route('clientes.index');}}" class="nav-link text-white">Clientes</a></li>
                    <li class="nav-item"><a href="{{route('compras.index');}}" class="nav-link text-white">Compras</a></li>
                    <li class="nav-item"><a href="{{route('ventas.index');}}" class="nav-link text-white">Ventas</a></li>
                    <li class="nav-item"><a href="{{route('ordenes.index');}}" class="nav-link text-white">Ordenes</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenido a Ferretería "AA"</h1>
            <p class="lead">Todo lo que necesitas para tu casa y trabajo.</p>
            <a href="#" class="btn btn-light btn-lg mt-3">Conoce nuestros servicios</a>
        </div>
    </section>

    <section class="features py-5">
        <div class="container">
            <h2 class="text-center mb-4">¿Por qué elegirnos?</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="icon mb-3 mx-auto" style="max-width: 120px;">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfwh5rBp__GrUu-SqfZPDVw6OinrJC8UKD5Q&s" alt="Envíos" class="img-fluid rounded" style="max-height: 120px;">
                    </div>
                    <h3>Envíos rápidos</h3>
                    <p>Recibe tus productos en tiempo récord, donde estés.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon mb-3 mx-auto" style="max-width: 120px;">
                        <img src="https://i.etsystatic.com/36262552/r/il/9abf14/4458711660/il_fullxfull.4458711660_852s.jpg" alt="Calidad" class="img-fluid rounded" style="max-height: 120px;">
                    </div>
                    <h3>Calidad garantizada</h3>
                    <p>Solo trabajamos con los mejores materiales y marcas.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon mb-3 mx-auto" style="max-width: 120px;">
                        <img src="https://static.vecteezy.com/system/resources/previews/004/994/259/non_2x/business-handshake-icon-free-vector.jpg" alt="Atención al cliente" class="img-fluid rounded" style="max-height: 120px;">
                    </div>
                    <h3>Atención al cliente</h3>
                    <p>Estamos aquí para ayudarte en todo lo que necesites.</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="bg-primary text-white py-4 text-center">
        <div class="container">
            <p>&copy; 2024 Ferretería "AA". Todos los derechos reservados.</p>
            <p>
                <a href="#" class="text-white">Política de Privacidad</a> | 
                <a href="#" class="text-white">Términos de Servicio</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
