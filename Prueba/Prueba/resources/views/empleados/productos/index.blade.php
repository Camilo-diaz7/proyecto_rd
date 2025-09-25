@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Productos</h2>
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
                <th>Precio</th>
                <th>Imagen</th>
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
