@extends('layouts.empleados')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h1 class="h4">Reservaciones</h1>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cantidad personas</th>
            <th>Cantidad de mesas</th>
            <th>Fecha de la reserva</th>
            <th>Ocasion</th>
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


</tr>
@endforeach

    </tbody>
</table>
@endsection
