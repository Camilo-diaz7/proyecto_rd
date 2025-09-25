@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Eventos</h2>
    
    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">🔍 Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.eventos.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nombre del evento, descripción...">
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
                    <label for="precio_min" class="form-label">Precio Min</label>
                    <input type="number" class="form-control" id="precio_min" name="precio_min" 
                           value="{{ request('precio_min') }}" placeholder="0" step="0.01">
                </div>
                
                <div class="col-md-1">
                    <label for="precio_max" class="form-label">Precio Max</label>
                    <input type="number" class="form-control" id="precio_max" name="precio_max" 
                           value="{{ request('precio_max') }}" placeholder="∞" step="0.01">
                </div>
                
                <div class="col-md-1">
                    <label for="capacidad_min" class="form-label">Cap. Min</label>
                    <input type="number" class="form-control" id="capacidad_min" name="capacidad_min" 
                           value="{{ request('capacidad_min') }}" placeholder="0" min="0">
                </div>
                
                <div class="col-md-1">
                    <label for="capacidad_max" class="form-label">Cap. Max</label>
                    <input type="number" class="form-control" id="capacidad_max" name="capacidad_max" 
                           value="{{ request('capacidad_max') }}" placeholder="∞" min="0">
                </div>
                
                <div class="col-md-1">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="eventos_futuros" name="eventos_futuros" 
                               value="1" {{ request('eventos_futuros') ? 'checked' : '' }}>
                        <label class="form-check-label" for="eventos_futuros">
                            Futuros
                        </label>
                    </div>
                </div>
                
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                    <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>
    
    <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary">Nuevo Evento</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombre_evento }}</td>
                <td>{{ $evento->capacidad_maxima }}</td>
                <td>{{ $evento->descripcion }}</td>
                <td>{{ $evento->fecha }}</td>
                <td>{{ $evento->hora_inicio }}</td>
                <td>$ {{ number_format($evento->precio_boleta, 3) }}</td>
                <td>
                                    @if($evento->imagen)
             <img src="{{ asset('storage/' . $evento->imagen) }}" 
             alt="Imagen de {{ $evento->nombre }}" 
             width="80" height="80"
             style="object-fit: cover; border-radius: 5px;">
             @else
             <span class="text-muted">Sin imagen</span>
              @endif
                </td>


                <td>
                    <a href="{{ route('admin.eventos.edit', $evento) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection