@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Reservaciones</h2>
    
    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">🔍 Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reservaciones.index') }}" class="row g-3">
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
                    <a href="{{ route('admin.reservaciones.index') }}" class="btn btn-secondary">Limpiar</a>
                    <a href="{{ route('admin.reservaciones.create') }}" class="btn btn-success ms-2">Nueva Reserva</a>
                </div>
            </form>
        </div>
    </div>
<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID del usuario</th>
            <th>Nombre y Cedula</th>
            <th>Cantidad personas</th>
            <th>Cantidad de mesas</th>
            <th>Fecha de la reserva</th>
            <th>Ocasion</th>
            <th>Acciones</th>
            
    </tr>
    </thead>
    <tbody>
    @foreach ($reservaciones as $reservacion)
    <tr>
        <td>{{ $reservacion->user->id }} </td>
        <td>{{ $reservacion->user->name }} - {{ $reservacion->user->numero_documento }}</td>
        <td>{{ $reservacion->cantidad_personas }}</td>
        <td>{{ $reservacion->cantidad_mesas }}</td>
        <td>{{ $reservacion->fecha_reservacion }}</td>
        <td>{{ $reservacion->ocasion }}</td>
        <td class="text-end">
            <a href="{{ route('admin.reservaciones.edit',$reservacion) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('admin.reservaciones.destroy',$reservacion) }}" method="post" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar producto')">Eliminar</button>    
        </form>
        </td>
    </tr>
    
    @endforeach
    </tbody>
</table>
</div>
@endsection