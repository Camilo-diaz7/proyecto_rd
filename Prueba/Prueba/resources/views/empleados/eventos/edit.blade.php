@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Evento</h2>

    <form action="{{ route('eventos.update', $evento->id_evento) }}" method="POST">
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
    <input type="number" name="precio_boleta" class="form-control" step="0.01" required>
</div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>