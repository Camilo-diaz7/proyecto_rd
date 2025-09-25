@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Eventos</h2>
    <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary">Nuevo Evento</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Precio</th>
                <th>Imagen</th>
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
                <td>$ {{ number_format($evento->precio_boleta, 3) }}</td>
                <td>
                                    @if($evento->imagen)
             <img src="{{ asset('storage/' . $evento->imagen) }}" 
             alt="Imagen de {{ $evento->nombre }}" 
             width="80" height="80"
             style="object-fit: cover; border-radius: 5px;">
             @else
             <span class="text-muted">Sin imagen</span>
              @endif
                </td>


                <td>
                    <a href="{{ route('admin.eventos.edit', $evento) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection