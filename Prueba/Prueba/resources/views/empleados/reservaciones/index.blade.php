@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Reservaciones</h2>
    
    <!-- Barra de búsqueda -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('admin.reservaciones.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Buscar por nombre o número de documento..." 
                           value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                    @if(!empty($search))
                        <a href="{{ route('admin.reservaciones.index') }}" class="btn btn-outline-danger">
                            <i class="fas fa-times"></i> Limpiar
                        </a>
                    @endif
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.reservaciones.create') }}" class="btn btn-primary">Nueva Reserva</a>
        </div>
    </div>

    @if(!empty($search))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> 
            Mostrando resultados para: <strong>"{{ $search }}"</strong>
            @if($reservaciones->count() == 0)
                - No se encontraron reservaciones.
            @else
                - {{ $reservaciones->count() }} reservación(es) encontrada(s).
            @endif
        </div>
    @endif
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
</table>
</div>
@endsection