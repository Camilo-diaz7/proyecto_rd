@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Ventas</h2>
    <a href="{{ route('admin.ventas.create') }}" class="btn btn-primary">Nueva Venta</a>
    
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
<table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Método</th>
                <th>Usuario</th>
                <th>Documento</th>
                <th>Acciones</th>
            </tr>
        </thead>
    <tbody>
    @foreach ($ventas as $venta)
    <tr>
        <td>{{ $venta->id_venta }}</td>
        <td>{{ $venta->fecha ? $venta->fecha->format('d/m/Y') : 'N/A' }}</td>
        <td>${{ number_format($venta->total, 3) }}</td>
        <td>
            <span class="badge bg-{{ $venta->metodo_pago == 'efectivo' ? 'success' : ($venta->metodo_pago == 'tarjeta' ? 'primary' : 'info') }}">
                {{ ucfirst($venta->metodo_pago) }}
            </span>
        </td>
        <td>{{ $venta->usuario ? $venta->usuario->name . ' ' . $venta->usuario->apellido : 'Sin usuario' }}</td>
        <td>{{ $venta->usuario ? $venta->usuario->numero_documento : 'N/A' }}</td>
        <td class="text-end">
            <a href="{{ route('admin.detalles.porVenta', $venta) }}" class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('admin.ventas.edit', $venta) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('admin.ventas.destroy', $venta) }}" method="post" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar venta?')">Eliminar</button>    
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection