@extends('layouts.empleados')
@section('title', 'Lista de tus reservas!')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1 class="h4">Ventas</h1>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Metodo de Pago</th>
            <th>ID de Usuario</th>
            <th>Nombre y Cedula</th>
            <th>Acciones</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($ventas as $venta)
    <tr>
        <td>{{ $venta->id_venta }}</td>
        <td>{{ $venta->fecha }}</td>
        <td>{{ $venta->total}}</td>
        <td>{{ $venta->metodo_pago }}</td>
        <td>{{ $venta->id }}</td>
        <td>{{ $venta->usuario->name ?? 'Sin usuario' }} - {{ $venta->usuario->numero_documento ?? 'N/A' }}</td>

        <td class="text-end">
            <a href="{{ route('empleado.detalles.porVenta',$venta)}}" class="btn btn-info">Ver</a>
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
@endsection
