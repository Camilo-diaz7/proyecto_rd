@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Detalles de la Venta #{{ $venta->id_venta }}</h2>
    <a href="{{ route('admin.detalles.create', ['venta_id' => $venta->id_venta]) }}" class="btn btn-primary">Nuevo Detalle</a>
    <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary">Volver</a>

<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalles as $detalle)
            <tr>
                <td>{{ $detalle->id_detalleV}}</td>
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