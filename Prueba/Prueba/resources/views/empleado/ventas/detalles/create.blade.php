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

    <form action="{{ route('detalles.store') }}" method="POST">
        @csrf

        <div>
            <label for="id_venta">ID de Venta Relacionada:</label>
            <input type="number" name="id_venta" id="id_venta" value="{{ old('id_venta') }}" required>
        </div>

        <div>
            <label for="id_producto">ID de Producto Relacionado:</label>
            <input type="number" name="id_producto" id="id_producto" value="{{ old('id_producto') }}" required>
        </div>

        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <div>
            <label for="precio_unitario">Precio Unitario:</label>
            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario') }}" required>
        </div>

        <div>
            <label for="cantidad_productos">Cantidad de Productos:</label>
            <input type="number" name="cantidad_productos" id="cantidad_productos" value="{{ old('cantidad_productos') }}" required>
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ route('detalles.index') }}">Cancelar</a>
    </form>
@endsection