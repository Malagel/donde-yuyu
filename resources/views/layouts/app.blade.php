<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Loganizas Donde Yuyú') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Longanizas Donde Yuyú</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        @if (Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link text-warning fw-semibold" href="/admin">Panel Admin</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="/cart" class="btn btn-outline-light btn-sm">
                        🛒 Ver Carrito
                    </a>

                    @auth

                        <form action="/logout" method="POST" class="d-inline mb-0">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                        </form>
                    @endauth

                    @guest
                        <a href="/login" class="btn btn-outline-light btn-sm">Iniciar Sesión</a>
                        <a href="/register" class="btn btn-light btn-sm">Registrarse</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>