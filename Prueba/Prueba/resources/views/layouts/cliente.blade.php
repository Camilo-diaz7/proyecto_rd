<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Agora Vives Pub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <a href="{{ route('cliente.dashboard') }}">
                <img src="{{ asset('imagenes/logo1.svg') }}" alt="logo" style="height:50px;">
            </a>
        </div>
        <nav>
            <ul class="d-flex gap-3 list-unstyled mb-0">
                <li><a href="{{ route('cliente.dashboard') }}" class="text-white">Dashboard</a></li>
                <li><a href="{{ route('cliente.reservaciones.index') }}" class="text-white">Reservaciones</a></li>
                <li><a href="{{ route('cliente.boletas.index') }}" class="text-white">Boletas</a></li>
                <li>
                    {{ Auth::user()->name }}
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-white ms-2">Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="py-4 container">
    @yield('content')
</main>
</body>
</html>
