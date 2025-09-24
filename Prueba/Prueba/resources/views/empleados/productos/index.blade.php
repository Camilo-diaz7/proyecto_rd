@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <h1>Productos</h1>

    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

    @if($productos->isEmpty())
        <div class="alert alert-info">
            No hay productos disponibles.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo de Producto</th>
                    <th>Stock</th>
                    <th>Precio Unitario</th>
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
                        <td>${{ number_format($producto->precio_unitario, 2) }}</td>

                        <td>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar este producto?')" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
