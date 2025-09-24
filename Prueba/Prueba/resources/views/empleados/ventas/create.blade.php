@extends('layouts.app')

@section('title', 'crear tu reserva')

@section('content')


<h1 class="h4 mb-3">Crea tu reserva Admin!</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>       
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('ventas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
    <label for="id_usuario" class="form-label">ID Usuario</label>
    <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="{{ old('id_usuario') }}" required>
</div>
    <div class="mb-3">
        <label for="total" class="form-label">Total</label>
        <input type="number" class="form-control" id="total" name="total" value="{{ old('total') }}" required>
    </div>

    <div class="mb-3">
    <label for="metodo_pago" class="form-label">Método de Pago</label>
    <select class="form-select" name="metodo_pago" id="metodo_pago" required>
        <option value="">-- Selecciona un método --</option>
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="transferencia">Transferencia</option>
    </select>
</div>


    <button type="submit" class="btn btn-danger">Guardar</button>
    <a href="{{ route('ventas.index') }}" class="btn btn-secondary" >Cancelar</a>

</form>
@endsection