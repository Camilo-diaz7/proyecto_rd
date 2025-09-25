<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin - Agora Vives Pub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
   body {
      background-color: #0d0d0d;
      color: #f8f9fa;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .sidebar {
      background-color: #1a1a1a;
      border-right: 1px solid #444;
      padding: 2rem 1rem;
      height: 100vh;
      width: 260px;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
    }

    .sidebar .logo-container {
      padding-bottom: 2rem;
      border-bottom: 1px solid #444;
      width: 100%;
      text-align: center;
    }

    .sidebar img {
      max-width: 140px;
    }

    .sidebar nav {
      width: 100%;
      margin-top: 2rem;
    }

    .sidebar nav a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #f8f9fa;
      padding: 15px 20px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      border-radius: 8px;
      margin-bottom: 8px;
    }

    .sidebar nav a:hover {
      background-color: #333;
      color: #ffd700;
    }


    .user-profile {
      width: 100%;
      margin-top: auto;
      padding-top: 2rem;
      border-top: 1px solid #444;
      text-align: center;
    }

    .user-profile p {
      font-size: 1rem;
      margin-bottom: 0;
      color: #fff;
    }

    .user-profile small {
      color: #999;
    }

    .dashboard-content {
      margin-left: 260px;
      padding: 30px;
      min-height: 100vh;
      background-color: #0d0d0d;
    }

    .header-dashboard {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.5rem 0;
      border-bottom: 1px solid #333;
      margin-bottom: 2rem;
    }

    .header-dashboard h1 {
      color: #ffd700;
      font-weight: 700;
    }

    .header-dashboard .user-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .user-info .profile-pic {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #000;
      font-weight: bold;
    }
  </style>
</head>
<body>
 <div class="d-flex">
  <div class="sidebar">
    <div class="logo-container">
      <img src="{{ asset('imagenes/logo1.svg') }}" alt="Logo">
    </div>
    <nav>
      <a href="{{ route('admin.empleados.index') }}" class="active">
        <i class="bi bi-people-fill"></i> Empleados
      </a>
      <a href="{{route('admin.eventos.index')}}">
        <i class="bi bi-calendar-event-fill"></i> Eventos
      </a>
      <a href="{{ route('admin.reservaciones.index') }}">
        <i class="bi bi-gear-fill"></i> Reservaciones
      </a>
      <a href="{{route('admin.ventas.index')  }}">
        <i class="bi bi-gear-fill"></i> Ventas
      </a>
      <a href="{{route('admin.productos.index')  }}">
        <i class="bi bi-gear-fill"></i> Productos
      </a>

 
    </nav>

    <div class="user-profile">
  <p class="mb-0 text-white fw-bold">
    {{ Auth::user()->name }} {{ Auth::user()->apellido }}
  </p>
  <small class="text-secondary">Administrador</small>
</div>
      <a href="{{ route('logout') }}" class="btn btn-logout mt-3"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
         <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </div>

  <div class="dashboard-content w-100">
    <div class="header-dashboard">
      <h1>Panel de Administración</h1>
      <div class="user-info d-flex align-items-center">
        <div class="d-none d-md-block">
  <p class="mb-0 text-white fw-bold">
    {{ Auth::user()->name }} {{ Auth::user()->apellido }}
  </p>
  <small class="text-secondary">Administrador</small>
</div>

      </div>
    </div>
    @yield('content')
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
