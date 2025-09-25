@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detalle del Empleado</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $empleado->id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $empleado->name }}</li>
        <li class="list-group-item"><strong>Apellido:</strong> {{ $empleado->apellido }}</li>
        <li class="list-group-item"><strong>Numero de documento</strong> {{ $empleado->numero_documento }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $empleado->email }}</li>
        <li class="list-group-item"><strong>Rol:</strong> {{ $empleado->role }}</li>
    </ul>

    <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
