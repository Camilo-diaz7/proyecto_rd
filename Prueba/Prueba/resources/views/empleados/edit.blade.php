@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Empleado</h1>

    <form action="{{ route('admin.empleados.update', $empleado) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $empleado->name }}" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ $empleado->apellido }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $empleado->email }}" required>
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <select name="role" class="form-control">
                <option value="empleado" {{ $empleado->role == 'empleado' ? 'selected' : '' }}>Empleado</option>
                <option value="cliente" {{ $empleado->role == 'cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="admin" {{ $empleado->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
