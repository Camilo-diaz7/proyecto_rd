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
            <label>Tipo de Documento</label>
            <select name="tipo_documento" class="form-control">
                <option value="CC" {{ $empleado->tipo_documento == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                <option value="TI" {{ $empleado->tipo_documento == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                <option value="CE" {{ $empleado->tipo_documento == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                <option value="PA" {{ $empleado->tipo_documento == 'PA' ? 'selected' : '' }}>Pasaporte</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Número de Documento</label>
            <input type="text" name="numero_documento" class="form-control" value="{{ $empleado->numero_documento }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $empleado->telefono }}">
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
