@extends('layouts.Empleado')

@section('content')

<div class="container">
    <h1>👨‍💼 Lista de Empleados</h1>

    {{-- Tabla solo lectura: empleados --}}
    <table class="table mt-3 table-striped table-hover shadow-sm">
        <thead class="table-info">
            <tr>
                <th>ID</th>
                <th>Número de documento</th>
                <th>Nombre y apellido</th>
                <th>Email</th>
                <th>Cargo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->numero_documento }}</td>
                <td>{{ $empleado->name }} {{ $empleado->apellido }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ ucfirst($empleado->role) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay empleados registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <hr class="my-5">

    <h1>👥 Lista de Clientes</h1>
    {{-- Tabla solo lectura: clientes --}}
    <table class="table mt-3 table-striped table-hover shadow-sm">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Número de documento</th>
                <th>Nombre y apellido</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->numero_documento ?? 'N/A' }}</td>
                <td>{{ $cliente->name }} {{ $cliente->apellido ?? '' }}</td>
                <td>{{ $cliente->email }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No hay clientes registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
