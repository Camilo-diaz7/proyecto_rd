@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles de la Venta #{{ $venta->id_venta }}</h2>
    <a href="{{ route('detalles.create') }}" class="btn btn-primary mb-3">Agregar detalle</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Venta Relacionada</th>
                <th>Producto Relacionado</th>
                <th>Descripcion</th>
                <th>Cantidad de detalles</th>
                <th>Precio Unitario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                <td>{{ $detalle->id_detalleV}}</td>
                    <td>{{ $detalle->id_venta }}</td>
                    <td>{{ $detalle->id_producto}} - {{ $detalle->producto->nombre}}</td>
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
</div>
@endsection