@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Evento</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.eventos.update', $evento->id_evento) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre del Evento</label>
            <input type="text" name="nombre_evento" class="form-control" value="{{ $evento->nombre_evento }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacidad Máxima</label>
            <input type="number" name="capacidad_maxima" class="form-control" value="{{ $evento->capacidad_maxima }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $evento->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ $evento->fecha }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hora de Inicio</label>
            <input type="time" name="hora_inicio" class="form-control" value="{{ $evento->hora_inicio }}" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="number" name="precio_boleta" class="form-control" value="{{ $evento->precio_boleta }}" step="0.01" required>
</div>

        <div class="mb-3">
            <label class="form-label">Imagen del Evento</label>
            @if($evento->imagen)
                <div class="mb-2">
                    <p><strong>Imagen actual:</strong></p>
                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" style="max-width: 200px; height: auto;" class="img-thumbnail">
                </div>
            @endif
            <input type="file" name="imagen" class="form-control" accept="image/*">
            <small class="form-text text-muted">Deja vacío si no quieres cambiar la imagen actual</small>
        </div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection