@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Reservaciones</h2>
    <a href="{{ route('admin.reservaciones.create') }}" class="btn btn-primary">Nueva Reserva</a>
<table class="table mt-3 table-striped">
    <thead>
        <tr>
            <th>ID del usuario</th>
            <th>Nombre y Cedula</th>
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
        <td>{{ $reservacion->user->id }} </td>
        <td>{{ $reservacion->user->name }} - {{ $reservacion->user->numero_documento }}</td>
        <td>{{ $reservacion->cantidad_personas }}</td>
        <td>{{ $reservacion->cantidad_mesas }}</td>
        <td>{{ $reservacion->fecha_reservacion }}</td>
        <td>{{ $reservacion->ocasion }}</td>
        <td class="text-end">
            <a href="{{ route('admin.reservaciones.edit',$reservacion) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('admin.reservaciones.destroy',$reservacion) }}" method="post" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar producto')">Eliminar</button>    
        </form>
        </td>
    </tr>
    
    @endforeach
    </tbody>
@endsection