@extends('layouts.admin')

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
<form action="{{ route('admin.ventas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Usuario</label>
        <div class="form-control bg-light">
            <strong>ID:</strong> {{ Auth::user()->id }} | 
            <strong>Nombre:</strong> {{ Auth::user()->name }} {{ Auth::user()->apellido }} | 
            <strong>Documento:</strong> {{ Auth::user()->numero_documento }}
        </div>
        <input type="hidden" name="id" value="{{ Auth::id() }}">
    </div>
    <div class="mb-3">
        <label>Total</label>
        <input type="number" step="0.01" class="form-control" name="total" value="{{ old('total') }}" required>
    </div>

    <div class="mb-3">
        <label>Método de Pago</label>
        <select class="form-control" name="metodo_pago" required>
            <option value="">-- Selecciona un método --</option>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
            <option value="transferencia">Transferencia</option>
        </select>
    </div>


    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('admin.ventas.index') }}" class="btn btn-secondary" >Cancelar</a>

</form>
@endsection