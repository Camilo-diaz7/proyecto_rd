@extends('layouts.app')
@section('title', 'Edita tu reservacion')

@section('content')
<h1 class="h4 mb-3">Editar tu venta</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>       
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('ventas.update', $venta) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="total" class="form-label">Total</label>
        <input type="number" class="form-control" id="total" name="total" value="{{ old('total', $venta->total) }}" required>
    </div>
 
    <div class="mb-3">
    <label for="metodo_pago" class="form-label">Método de Pago</label>
    <select class="form-select" id="metodo_pago" name="metodo_pago" required>
        <option value="efectivo" {{ old('metodo_pago', $venta->metodo_pago ?? '') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
        <option value="tarjeta" {{ old('metodo_pago', $venta->metodo_pago ?? '') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
        <option value="transferencia" {{ old('metodo_pago', $venta->metodo_pago ?? '') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
    </select>
</div>



    <button type="submit" class="btn btn-danger">Actualizar</button>
    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection