@extends('layouts.app')

@section('content')
    <h1>Registrar nuevo producto</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div>
            <label for="tipo_producto">Tipo de Producto:</label>
            <textarea name="tipo_producto" id="tipo_producto">{{ old('tipo_producto') }}</textarea>
        </div>

        <div>
            <label for="precio_unitario">Precio Unitario:</label>
            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario') }}" required>
        </div>

        <div>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required>
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ route('productos.index') }}">Cancelar</a>
    </form>
@endsection
