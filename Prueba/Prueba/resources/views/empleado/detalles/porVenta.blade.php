@extends('layouts.empleados')

@section('content')
<div class="container">
    <h2>Detalles de la Venta #{{ $venta->id_venta }}</h2>
    <a href="{{ route('empleado.ventas.index') }}" class="btn btn-secondary">Volver a Ventas</a>

<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($detalles as $detalle)
            @php 
                $subtotal = $detalle->cantidad_productos * $detalle->precio_unitario;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $detalle->id_detalleV}}</td>
                <td>{{ $detalle->producto ? $detalle->producto->nombre : 'N/A' }}</td>
                <td>{{ $detalle->descripcion }}</td>
                <td>{{ $detalle->cantidad_productos }}</td>
                <td>${{ number_format($detalle->precio_unitario, 3) }}</td>
                <td>${{ number_format($subtotal, 3) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="table-info">
            <th colspan="5" class="text-end">Total:</th>
            <th>${{ number_format($total, 3) }}</th>
        </tr>
    </tfoot>
</table>

@if($detalles->isEmpty())
    <div class="alert alert-info">
        No hay detalles registrados para esta venta.
    </div>
@endif
</div>
@endsection
