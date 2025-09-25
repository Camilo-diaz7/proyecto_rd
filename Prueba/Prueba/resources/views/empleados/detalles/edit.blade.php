@extends('layouts.admin')

@section('content')
<h1 class="h4 mb-3">Editar Detalle</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>       
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.detalles.update', $detalle) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label>ID de Venta</label>
        <input type="number" class="form-control" name="id_venta" value="{{ old('id_venta', $detalle->id_venta) }}" required>
    </div>
    <div class="mb-3">
        <label>ID de Producto</label>
        <input type="number" class="form-control" name="id_producto" value="{{ old('id_producto', $detalle->id_producto) }}" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $detalle->descripcion) }}</textarea>
    </div>
    <div class="mb-3">
        <label>Cantidad de Productos</label>
        <input type="number" class="form-control" name="cantidad_productos" value="{{ old('cantidad_productos', $detalle->cantidad_productos) }}" required>
    </div>
    <div class="mb-3">
        <label>Precio Unitario</label>
        <input type="number" step="0.01" class="form-control" name="precio_unitario" value="{{ old('precio_unitario', $detalle->precio_unitario) }}" required>
    </div>

    <button type="submit" class="btn btn-danger">Actualizar</button>
    <a href="{{ route('admin.detalles.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
