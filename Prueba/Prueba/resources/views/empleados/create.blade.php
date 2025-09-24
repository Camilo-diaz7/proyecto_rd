@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Nuevo Empleado</h1>

    <form action="{{ route('admin.empleados.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <select name="role" class="form-control">
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
