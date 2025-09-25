@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Crear Evento</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.eventos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre del Evento</label>
            <input type="text" name="nombre_evento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacidad Máxima</label>
            <input type="number" name="capacidad_maxima" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hora de Inicio</label>
            <input type="time" name="hora_inicio" class="form-control" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="number" name="precio_boleta" class="form-control" step="0.01" required>
    </div>

        <div class="mb-3">
            <label class="form-label">Imagen del Evento</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
            <small class="form-text text-muted">Formatos permitidos: JPG, JPEG, PNG (máximo 2MB)</small>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection