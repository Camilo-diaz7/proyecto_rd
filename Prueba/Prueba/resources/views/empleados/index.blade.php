@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Lista de Empleados</h1>
    <a href="{{ route('admin.empleados.create') }}" class="btn btn-primary">➕ Nuevo Empleado</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3 table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->name }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->role }}</td>
                <td>
                    <a href="{{ route('admin.empleados.show', $empleado) }}" class="btn btn-info btn-sm">👁 Ver</a>
                    <a href="{{ route('admin.empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                    <form action="{{ route('admin.empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑 Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
