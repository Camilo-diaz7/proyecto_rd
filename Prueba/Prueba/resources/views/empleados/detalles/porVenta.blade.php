@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Detalles de la Venta #{{ $venta->id_venta }}</h2>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información de la Venta</h5>
                    <p><strong>Cliente:</strong> {{ $venta->usuario ? $venta->usuario->name . ' ' . $venta->usuario->apellido : 'N/A' }}</p>
                    <p><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y H:i') }}</p>
                    <p><strong>Método de Pago:</strong> {{ ucfirst($venta->metodo_pago) }}</p>
                    <p><strong>Total:</strong> <span class="text-success font-weight-bold">${{ number_format($venta->total_calculado, 3) }}</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        @if($detalles->isEmpty())
            <a href="{{ route('admin.detalles.create', ['venta_id' => $venta->id_venta]) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Detalle
            </a>
        @endif
        <a href="{{ route('admin.detalles.createMultiple', ['venta_id' => $venta->id_venta]) }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Múltiples Productos
        </a>
        <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>

<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
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
                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td><strong>${{ number_format($detalle->subtotal, 2) }}</strong></td>
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
    <tfoot>
        <tr>
            <th colspan="5" class="text-end">Total de la Venta:</th>
            <th class="text-success">${{ number_format($venta->total_calculado, 3) }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>

@if($detalles->isEmpty())
    <div class="alert alert-info mt-3">
        <i class="fas fa-info-circle"></i> 
        No hay detalles para esta venta. El total se calculará automáticamente cuando agregues productos.
    </div>
@endif

</div>
@endsection