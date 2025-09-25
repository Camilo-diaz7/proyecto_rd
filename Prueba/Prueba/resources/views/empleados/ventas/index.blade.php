@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Ventas</h2>
    
    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"> Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.ventas.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="ID, cliente, documento...">
                </div>
                
                <div class="col-md-2">
                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                    <select class="form-select" id="metodo_pago" name="metodo_pago">
                        <option value="">Todos</option>
                        <option value="efectivo" {{ request('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="tarjeta" {{ request('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                        <option value="transferencia" {{ request('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="fecha_desde" class="form-label">Desde</label>
                    <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" 
                           value="{{ request('fecha_desde') }}">
                </div>
                
                <div class="col-md-2">
                    <label for="fecha_hasta" class="form-label">Hasta</label>
                    <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" 
                           value="{{ request('fecha_hasta') }}">
                </div>
                
                <div class="col-md-1">
                    <label for="total_min" class="form-label">Total Min</label>
                    <input type="number" class="form-control" id="total_min" name="total_min" 
                           value="{{ request('total_min') }}" placeholder="0" step="0.01">
                </div>
                
                <div class="col-md-1">
                    <label for="total_max" class="form-label">Total Max</label>
                    <input type="number" class="form-control" id="total_max" name="total_max" 
                           value="{{ request('total_max') }}" placeholder="∞" step="0.01">
                </div>
                
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                    <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>
    
    <a href="{{ route('admin.ventas.create') }}" class="btn btn-primary">Nueva venta</a>
<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha y Hora</th>
            <th>Total</th>
            <th>Metodo de Pago</th>
            <th>ID de user</th>
            <th>Nombre y Cedula</th>
            <th>Acciones</th>
            
    </tr>
    </thead>
    <tbody>
    @foreach ($ventas as $venta)
    <tr>
        <td>{{ $venta->id_venta }}</td>
        <td>{{ $venta->fecha }}</td>
        <td>${{ number_format($venta->total_calculado, 3) }}</td>
        <td>{{ $venta->metodo_pago }}</td>
        <td>{{ $venta->id }}</td>
        <td>{{ $venta->usuario->name ?? 'Sin usuario' }} - {{ $venta->usuario->numero_documento ?? 'N/A' }}</td>

        <td class="text-end">
            <a href="{{ route('admin.detalles.porVenta',$venta)}}" class="btn btn-info">Ver</a>
            <a href="{{ route('admin.ventas.edit',$venta) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('admin.ventas.destroy',$venta) }}" method="post" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar venta')">Eliminar</button>    
        </form>
        </td>
    </tr>
    
    @endforeach
    </tbody>
@endsection