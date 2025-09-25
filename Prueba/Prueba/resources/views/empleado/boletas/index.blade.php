@extends('layouts.empleados')

@section('content')
<div class="container">
    <h2>Lista de Boletas</h2>
    
    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('empleado.boletas.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="ID, cliente, evento...">
                </div>
                
                <div class="col-md-3">
                    <label for="id_evento" class="form-label">Evento</label>
                    <select class="form-select" id="id_evento" name="id_evento">
                        <option value="">Todos los eventos</option>
                        @foreach(\App\Models\Evento::all() as $evento)
                            <option value="{{ $evento->id_evento }}" {{ request('id_evento') == $evento->id_evento ? 'selected' : '' }}>
                                {{ $evento->nombre_evento }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-1">
                    <label for="cantidad_min" class="form-label">Cant. Min</label>
                    <input type="number" class="form-control" id="cantidad_min" name="cantidad_min" 
                           value="{{ request('cantidad_min') }}" placeholder="0" min="0">
                </div>
                
                <div class="col-md-1">
                    <label for="cantidad_max" class="form-label">Cant. Max</label>
                    <input type="number" class="form-control" id="cantidad_max" name="cantidad_max" 
                           value="{{ request('cantidad_max') }}" placeholder="∞" min="0">
                </div>
                
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                    <a href="{{ route('empleado.boletas.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Evento</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boletas as $boleta)
            <tr>
                <td>{{ $boleta->id_boleta }}</td>

                {{-- Usuario --}}
                <td>{{ $boleta->user?->name ?? Auth::user()->name }}</td>

                {{-- Evento --}}
                <td>
                    {{ $boleta->evento?->nombre_evento ?? 'Evento no asignado' }}
                </td>

                {{-- Cantidad --}}
                <td>{{ $boleta->cantidad_boletos }}</td>

                {{-- Precio Unitario --}}
                <td>$ {{ number_format($boleta->evento?->precio_boleta ?? 0, 2) }}</td>

                {{-- Total --}}
                <td>$ {{ number_format($boleta->cantidad_boletos * ($boleta->evento?->precio_boleta ?? 0), 2) }}</td>

                {{-- Acciones --}}
                <td>
                    <a href="{{ route('cliente.boletas.edit', ['boleta' => $boleta->id_boleta]) }}" class="btn btn-dark">Editar</a>
                    <form action="{{ route('cliente.boletas.destroy', ['boleta' => $boleta->id_boleta]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que desea eliminar esta boleta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


