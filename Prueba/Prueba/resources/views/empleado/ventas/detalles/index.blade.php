@extends('layouts.app')

@section('title', 'Lista de Detalles de Venta')

@section('content')
    <h1>Detalles</h1>

    <a href="{{ route('detalles.create') }}" class="btn btn-primary mb-3">Agregar detalle</a>

    @if($detalleVenta->isEmpty())
        <div class="alert alert-info">
            No hay detalles disponibles.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID de Venta Relacionada</th>
                    <th>ID de Producto Relacionado</th>
                    <th>Descripcion</th>
                    <th>Cantidad de detalles</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalleVenta as $detalle)
                    <tr>
                        <td>{{ $detalle->id_detalleV}}</td>
                        <td>{{ $detalle->id_venta }}</td>
                        <td>{{ $detalle->id_producto }}</td>
                        <td>{{ $detalle->descripcion }}</td>
                        <td>{{ $detalle->cantidad_productos }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 3) }}</td>

                        <td>
                            <a href="{{ route('detalles.edit', $detalle) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('detalles.destroy', $detalle) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar este detalle?')" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
