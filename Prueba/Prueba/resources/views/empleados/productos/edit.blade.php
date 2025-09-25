@extends('layouts.admin')

@section('content')
    <h1>Editar producto</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div>
            <label for="tipo_producto">Descripción:</label>
            <textarea name="tipo_producto" id="tipo_producto" class="form-control" >{{ old('tipo_producto', $producto->tipo_producto) }}</textarea>
        </div>

        <div>
            <label for="precio_unitario">Precio:</label>
            <input type="number" step="0.01" name="precio_unitario" class="form-control"  id="precio_unitario" value="{{ old('precio_unitario', $producto->precio_unitario) }}" required>
        </div>

        <div>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" class="form-control" id="stock" value="{{ old('stock', $producto->stock) }}" required>
        </div>
        <br>

        <div class="mb-3">
            <label>Imagen</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection