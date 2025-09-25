@extends('layouts.app')


@section('content')
<h1 class="h4 mb-3">Editar tu reserva</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('cliente.reservaciones.update', $reservacione) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="id" class="form-label">Usuario</label>
        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
        <input type="hidden" name="id" value="{{ Auth::id() }}">
    </div>

    <div class="mb-3">
        <label for="cantidad_personas" class="form-label">Cantidad Personas</label>
        <input type="number" class="form-control" name="cantidad_personas" value="{{ old('cantidad_personas', $reservacione->cantidad_personas) }}" required>
    </div>

    <div class="mb-3">
        <label for="cantidad_mesas" class="form-label">Cantidad Mesas</label>
        <input type="number" class="form-control" name="cantidad_mesas" value="{{ old('cantidad_mesas', $reservacione->cantidad_mesas) }}" required>
    </div>

    <div class="mb-3">
        <label for="fecha_reservacion" class="form-label">Fecha de la Reservación</label>
        <input type="date" class="form-control" name="fecha_reservacion" value="{{ old('fecha_reservacion', $reservacione->fecha_reservacion) }}" required>
    </div>

    <div class="mb-3">
        <label for="ocasion" class="form-label">Ocasión</label>
        <textarea class="form-control" name="ocasion" rows="5" required>{{ old('ocasion', $reservacione->ocasion) }}</textarea>
    </div>

    <button type="submit" class="btn btn-danger">Actualizar</button>
    <a href="{{ route('cliente.reservaciones.index') }}" class="btn btn-secondary">Cancelar</a>
</form>


@endsection