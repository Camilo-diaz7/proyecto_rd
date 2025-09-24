@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Boletas</h2>
    <a href="{{ route('cliente.boletas.create') }}" class="btn btn-danger mb-3">Nueva Boleta</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Evento</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boletas as $boleta)
            <tr>
                <td>{{ $boleta->id_boleta }}</td>

                {{-- Usuario --}}
                <td>{{ Auth::user()->name ?? 'Usuario no asignado' }}</td>

                {{-- Evento --}}
                <td>
                    {{ $boleta->evento?->nombre_evento ?? 'Evento no asignado' }}
                </td>

                {{-- Cantidad --}}
                <td>{{ $boleta->cantidad_boletos }}</td>

                {{-- Precio Unitario --}}
                <td>$ {{ number_format($boleta->evento?->precio_boleta ?? 0, 2) }}</td>

                {{-- Total --}}
                <td>$ {{ number_format($boleta->cantidad_boletos * ($boleta->evento?->precio_boleta ?? 0), 2) }}</td>

                {{-- Acciones --}}
                <td>
                    <a href="{{ route('cliente.boletas.edit', ['boleta' => $boleta->id_boleta]) }}" class="btn btn-dark btn-sm">Editar</a>
                    <form action="{{ route('cliente.boletas.destroy', ['boleta' => $boleta->id_boleta]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea eliminar esta boleta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


