@extends('layouts.app')

@section('content')
  

    <h2>Lista de tus Reservaciones</h2>
    <a href="{{ route('cliente.reservaciones.create') }}" class="btn btn-danger mb-3">Nueva reserva</a>

<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad personas</th>
            <th>Cantidad de mesas</th>
            <th>Fecha de la reserva</th>
            <th>Ocasion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservaciones as $reservacion)
<tr>
    {{-- Usuario logueado --}}
    <td>{{ Auth::user()->name ?? 'Usuario no asignado' }}</td>

    {{-- Cantidad personas --}}
    <td>{{ $reservacion->cantidad_personas }}</td>

    {{-- Cantidad mesas --}}
    <td>{{ $reservacion->cantidad_mesas }}</td>

    {{-- Fecha --}}
    <td>{{ $reservacion->fecha_reservacion }}</td>

    {{-- Ocasion --}}
    <td>{{ $reservacion->ocasion }}</td>

    {{-- Acciones --}}
    <td>
        <a href="{{ route('cliente.reservaciones.edit', $reservacion->id_reservacion) }}" class="btn btn-dark">Editar</a>
        <form action="{{ route('cliente.reservaciones.destroy',$reservacion) }}" method="post" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Eliminar reservacion?')">Eliminar</button>    
        </form>
    </td>
</tr>
@endforeach

    </tbody>
</table>
</div>
@endsection
