@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Productos</h2>
    
    <!-- Filtros de búsqueda -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">🔍 Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.productos.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Búsqueda General</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nombre, tipo de producto...">
                </div>
                
                <div class="col-md-2">
                    <label for="tipo_producto" class="form-label">Tipo de Producto</label>
                    <select class="form-select" id="tipo_producto" name="tipo_producto">
                        <option value="">Todos</option>
                        @php
                            $tipos = \App\Models\Producto::distinct()->pluck('tipo_producto')->filter();
                        @endphp
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo }}" {{ request('tipo_producto') == $tipo ? 'selected' : '' }}>
                                {{ ucfirst($tipo) }}
                            </option>
                        @endforeach
                    </select>
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
                    <label for="stock_min" class="form-label">Stock Min</label>
                    <input type="number" class="form-control" id="stock_min" name="stock_min" 
                           value="{{ request('stock_min') }}" placeholder="0" min="0">
                </div>
                
                <div class="col-md-1">
                    <label for="stock_max" class="form-label">Stock Max</label>
                    <input type="number" class="form-control" id="stock_max" name="stock_max" 
                           value="{{ request('stock_max') }}" placeholder="∞" min="0">
                </div>
                
                <div class="col-md-1">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="sin_stock" name="sin_stock" 
                               value="1" {{ request('sin_stock') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sin_stock">
                            Sin Stock
                        </label>
                    </div>
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
    </div>
    
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Nuevo Producto</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id_producto }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->tipo_producto }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
            @if($producto->imagen)
             <img src="{{ asset('storage/' . $producto->imagen) }}" 
             alt="Imagen de {{ $producto->nombre }}" 
             width="80" height="80"
             style="object-fit: cover; border-radius: 5px;">
             @else
             <span class="text-muted">Sin imagen</span>
              @endif
            </td>
                <td>${{ number_format($producto->precio_unitario, 3) }}</td>
                <td>
                    <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" style="display:inline;">
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