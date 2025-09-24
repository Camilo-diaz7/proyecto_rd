<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Agora Vives Pub') }}</title>

      <!-- Fuentes -->
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- Estilos personalizados -->
      <style>
          body {
            background-color: #fff;
            color: #000;
          }
          header {
            background-color: #000;
            padding: 1rem 0;
            color: white;
          }
          .logo img {
            max-width: 200px;
          }
          nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 1.5rem;
          }
          nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 19px;
            margin-left: 15px;
          }
          nav a:hover {
            text-decoration: none;
            color: rgb(156, 82, 82);
          }
          .contenido h2 {
            color: #8B0000;
          }
          .footer {
            background-color: #000;
            padding: 1rem;
            text-align: center;
            color: white;
            margin-top: 2rem;
          }
          .footer a {
            color: #fff;
            text-decoration: underline;
          }
          .footer a:hover {
            color: #ffcccc;
          }
          iframe {
            width: 100%;
            height: 250px;
            border: none;
            border-radius: 10px;
          }
          .img-bar {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 1rem;
          }
          .producto {
            background-color: #000000; /* fondo claro */
            border: 2px solid #ffffff; /* borde rojo oscuro */
            border-radius: 25px;
            padding: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 2px 8px rgba(5, 10, 5, 5.1);
            display: flex;
            
          }

          .producto:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 16px rgba(178, 58, 58, 0.985);
          }

          .producto img {
            border-radius: 10px;
            margin-bottom: 10px;
            max-height: 260px;
            object-fit: contain;
          }

          .producto p {
            margin: 0.2rem 0;
            font-family: 'Oswald', sans-serif;
            font-size: 1rem;
          }

          .footer {
            background-color: #000000;
            padding: 1rem;
            text-align: center;
            color: white;
            margin-top: 2rem;
          }

          .footer a {
            color: #fff;
            text-decoration: underline;
          }

          .footer a:hover {
            color: #ffcccc;
          }
      </style>
      @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>
  <body>
    <header class="container-fluid">
      <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
          <a href="{{ url('/') }}">
            <img src="{{ asset('imagenes/logo1.svg') }}" alt="logo" class="img-fluid" style="margin-left: 25px;"/>
          </a>
      </div>
        <nav>
          <ul class="d-flex">
    <li><a href="{{ url('/') }}">Conócenos</a></li>
    <li><a href="{{ url('/catalogo') }}">Catálogo</a></li>
    <li><a href="{{ url('/eventos') }}">Eventos</a></li>

    @guest
        @if (Route::has('login'))
            <li><a href="{{ route('login') }}" class="text-danger">Iniciar sesión</a></li>
        @endif
        @if (Route::has('register'))
            <li><a href="{{ route('register') }}" class="text-danger">Registrarse</a></li>
        @endif
    @else
        <li>{{ Auth::user()->name }}</li>
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endguest
</ul>

        </nav>
      </div>
    </header>

    <main class="py-4 container">
        @yield('content')
    </main>

    <footer class="footer">
      <div class="footer-contenido">
        <p><strong>📍 Dirección:</strong> Calle 123 #45-67, Bogotá, Colombia</p>
        <p><a href="#">Términos y condiciones</a> | <a href="#">Política de privacidad</a></p>
        <p><strong>📧 Contacto:</strong> agoravives@correo.com</p>
        <p>&copy; 2025 Agora Vives Pub. Todos los derechos reservados.</p>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
