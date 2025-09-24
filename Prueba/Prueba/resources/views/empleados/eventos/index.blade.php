@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Eventos</h2>
    <a href="{{ route('eventos.create') }}" class="btn btn-danger mb-3">Nuevo Evento</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>DescripciÃ³n</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombre_evento }}</td>
                <td>{{ $evento->capacidad_maxima }}</td>
                <td>{{ $evento->descripcion }}</td>
                <td>{{ $evento->fecha }}</td>
                <td>{{ $evento->hora_inicio }}</td>
                <td>$ {{ number_format($evento->precio_boleta, 2) }}</td>

                <td>
                    <a href="{{ route('eventos.edit', $evento->id_evento) }}" class="btn btn-dark btn-sm">Editar</a>
                    <form action="{{ route('eventos.destroy', $evento->id_evento) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Â¿Seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection