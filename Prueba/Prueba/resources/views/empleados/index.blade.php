@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Empleados</h2>
    
    <!-- Filtros de búsqueda para Empleados -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filtros de Búsqueda - Empleados</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.empleados.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search_empleados" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search_empleados" name="search_empleados" 
                           value="{{ request('search_empleados') }}" placeholder="Nombre, email, documento...">
                </div>
                
                <div class="col-md-2">
                    <label for="tipo_documento_empleados" class="form-label">Tipo Documento</label>
                    <select class="form-select" id="tipo_documento_empleados" name="tipo_documento_empleados">
                        <option value="">Todos</option>
                        <option value="CC" {{ request('tipo_documento_empleados') == 'CC' ? 'selected' : '' }}>CC</option>
                        <option value="CE" {{ request('tipo_documento_empleados') == 'CE' ? 'selected' : '' }}>CE</option>
                    </select>
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrar Empleados</button>
                    <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>
    
    <a href="{{ route('admin.empleados.create') }}" class="btn btn-primary">Nuevo Usuario</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Numero de documento</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->name }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->numero_documento }}</td>
                <td>{{ $empleado->role }}</td>
                <td>
                    <a href="{{ route('admin.empleados.show', $empleado) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('admin.empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>


    </table>
     <hr class="my-5">

    <h2>Lista de Clientes</h2>
    
    <!-- Filtros de búsqueda para Clientes -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">🔍 Filtros de Búsqueda - Clientes</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.empleados.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search_clientes" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search_clientes" name="search_clientes" 
                           value="{{ request('search_clientes') }}" placeholder="Nombre, email, documento...">
                </div>
                
                <div class="col-md-2">
                    <label for="tipo_documento_clientes" class="form-label">Tipo Documento</label>
                    <select class="form-select" id="tipo_documento_clientes" name="tipo_documento_clientes">
                        <option value="">Todos</option>
                        <option value="CC" {{ request('tipo_documento_clientes') == 'CC' ? 'selected' : '' }}>CC</option>
                        <option value="CE" {{ request('tipo_documento_clientes') == 'CE' ? 'selected' : '' }}>CE</option>
                    </select>
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success me-2">Filtrar Clientes</button>
                    <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>
    
    {{-- Tabla solo lectura: clientes --}}
    <table class="table mt-3 table-striped">
        <thead class="table">
            <tr>
                <th>ID</th>
                <th>Número de documento</th>
                <th>Nombre y apellido</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->numero_documento ?? 'N/A' }}</td>
                <td>{{ $cliente->name }} {{ $cliente->apellido ?? '' }}</td>
                <td>{{ $cliente->email }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No hay clientes registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
@endsection
