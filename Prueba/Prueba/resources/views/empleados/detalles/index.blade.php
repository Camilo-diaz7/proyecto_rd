@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Detalles de Venta</h2>
    
    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">🔍 Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.detalles.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Descripción, producto, venta...">
                </div>
                
                <div class="col-md-2">
                    <label for="id_venta" class="form-label">ID Venta</label>
                    <input type="number" class="form-control" id="id_venta" name="id_venta" 
                           value="{{ request('id_venta') }}" placeholder="Ej: 123">
                </div>
                
                <div class="col-md-2">
                    <label for="id_producto" class="form-label">ID Producto</label>
                    <input type="number" class="form-control" id="id_producto" name="id_producto" 
                           value="{{ request('id_producto') }}" placeholder="Ej: 456">
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
                    <label for="cantidad_min" class="form-label">Cant. Min</label>
                    <input type="number" class="form-control" id="cantidad_min" name="cantidad_min" 
                           value="{{ request('cantidad_min') }}" placeholder="0" min="0">
                </div>
                
                <div class="col-md-1">
                    <label for="cantidad_max" class="form-label">Cant. Max</label>
                    <input type="number" class="form-control" id="cantidad_max" name="cantidad_max" 
                           value="{{ request('cantidad_max') }}" placeholder="∞" min="0">
                </div>
                
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                    <a href="{{ route('admin.detalles.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>
    
    <a href="{{ route('admin.detalles.create') }}" class="btn btn-primary">Nuevo Detalle</a>
    
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Venta</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($detalleVenta as $detalle)
    <tr>
        <td>{{ $detalle->id_detalleV }}</td>
        <td>{{ $detalle->id_venta }}</td>
        <td>{{ $detalle->producto ? $detalle->producto->nombre : 'N/A' }}</td>
        <td>{{ $detalle->descripcion }}</td>
        <td>{{ $detalle->cantidad_productos }}</td>
        <td>${{ number_format($detalle->precio_unitario, 3) }}</td>
        <td class="text-end">
            <a href="{{ route('admin.detalles.edit', $detalle) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('admin.detalles.destroy', $detalle) }}" method="post" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar detalle?')">Eliminar</button>    
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
