@extends('layouts.empleados')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h1 class="h4">Reservaciones</h1>
</div>

<!-- Filtros de búsqueda -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Filtros de Búsqueda</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('empleado.reservaciones.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="search" class="form-label">Búsqueda General</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Cliente, ocasión...">
            </div>
            
            <div class="col-md-2">
                <label for="fecha_desde" class="form-label">Fecha Desde</label>
                <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" 
                       value="{{ request('fecha_desde') }}">
            </div>
            
            <div class="col-md-2">
                <label for="fecha_hasta" class="form-label">Fecha Hasta</label>
                <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" 
                       value="{{ request('fecha_hasta') }}">
            </div>
            
            <div class="col-md-1">
                <label for="personas_min" class="form-label">Personas Min</label>
                <input type="number" class="form-control" id="personas_min" name="personas_min" 
                       value="{{ request('personas_min') }}" placeholder="0" min="0">
            </div>
            
            <div class="col-md-1">
                <label for="personas_max" class="form-label">Personas Max</label>
                <input type="number" class="form-control" id="personas_max" name="personas_max" 
                       value="{{ request('personas_max') }}" placeholder="∞" min="0">
            </div>
            
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                <a href="{{ route('empleado.reservaciones.index') }}" class="btn btn-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad personas</th>
            <th>Cantidad de mesas</th>
            <th>Fecha de la reserva</th>
            <th>Ocasion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservaciones as $reservacion)
<tr>
    {{-- Usuario logueado --}}
    <td>{{ Auth::user()->name ?? 'Usuario no asignado' }}</td>

    {{-- Cantidad personas --}}
    <td>{{ $reservacion->cantidad_personas }}</td>

    {{-- Cantidad mesas --}}
    <td>{{ $reservacion->cantidad_mesas }}</td>

    {{-- Fecha --}}
    <td>{{ $reservacion->fecha_reservacion }}</td>

    {{-- Ocasion --}}
    <td>{{ $reservacion->ocasion }}</td>


</tr>
@endforeach

    </tbody>
</table>
@endsection
