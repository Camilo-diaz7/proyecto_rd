@extends('layouts.app')
@section('title', 'Lista de tus reservas!')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1 class="h4">Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary">Nuevo</a>
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
        <td>{{ $venta->id_usuario }}</td>
        <td>{{ $venta->usuario->nombre }} - {{ $venta->usuario->cedula }}</td>

        <td class="text-end">
            <a href="{{ route('detalles.porVenta',$venta)}}" class="btn btn-info">Ver</a>
            <a href="{{ route('ventas.edit',$venta) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('ventas.destroy',$venta) }}" method="post" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar venta')">Eliminar</button>    
        </form>
        </td>
    </tr>
    
    @endforeach
    </tbody>
@endsection