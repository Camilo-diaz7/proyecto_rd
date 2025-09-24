@extends('layouts.app');

@section('title', 'crear tu reserva')

@section('content')


<h1 class="h4 mb-3">Crea tu reserva</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>       
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('reservaciones.store') }}" method="POST">
    @csrf
    <div class="mb-3">
    <label for="id_usuario" class="form-label">ID Usuario</label>
    <input type="number" class="form-control" id="id_usuario" name="id_usuario" value="{{ old('id_usuario') }}" required>
</div>
    <div class="mb-3">
        <label for="cantidad_personas" class="form-label">Cantidad Personas</label>
        <input type="number" class="form-control" id="cantidad_personas" name="cantidad_personas" value="{{ old('cantidad_personas') }}" required>
    </div>
    <div class="mb-3">
        <label for="cantidad_mesas" class="form-label">Cantidad Mesas</label>
        <input type="number" class="form-control" id="cantidad_mesas" name="cantidad_mesas" value="{{ old('cantidad_mesas') }}" required>
    </div>
    <div class="mb-3">
        <label for="fecha_reservacion" class="form-label">Fecha de la Reservacion</label>
        <input type="date" class="form-control" id="fecha_reservacion" name="fecha_reservacion" value="{{ old('fecha_reservacion') }}" required>
    </div>

    <div class="mb-3">
        <label for="ocasion" class="form-label">Ocasion</label>
        <textarea class="form-control" id="ocasion" name="ocasion" rows="5" {{ old('ocasion') }} required></textarea>
    </div>

    <button type="submit" class="btn btn-danger">Guardar</button>
    <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary" >Cancelar</a>

</form>
@endsection