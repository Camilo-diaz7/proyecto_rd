@extends('layouts.app')

@section('content')
  
<div class="d-flex justify-content-between mb-3">
    <h1 class="h4">Reservaciones</h1>
    <a href="{{ route('reservaciones.create') }}" class="btn btn-danger">Nuevo</a>
</div>

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
        <a href="{{ route('reservaciones.show',$reservacion)}}" class="btn btn-dark">Ver</a>
        <a href="{{ route('reservaciones.edit', $reservacion->id_reservacion) }}" class="btn btn-danger">Editar</a>
        <form action="{{ route('reservaciones.destroy',$reservacion) }}" method="post" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-secondary" onclick="return confirm('Eliminar reservacion?')">Eliminar</button>    
        </form>
    </td>
</tr>
@endforeach

    </tbody>
</table>
@endsection
