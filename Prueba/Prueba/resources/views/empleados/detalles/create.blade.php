@extends('layouts.admin')

@section('content')

<h1 class="h4 mb-3">Crear Nuevo Detalle</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>       
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.detalles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>ID de Venta</label>
        @if($venta_id)
            <input type="number" class="form-control bg-light" name="id_venta" value="{{ $venta_id }}" readonly>
            <small class="form-text text-muted">Venta seleccionada automáticamente</small>
        @else
            <input type="number" class="form-control" name="id_venta" value="{{ old('id_venta') }}" required>
        @endif
    </div>
    <div class="mb-3">
        <label>Producto</label>
        <select class="form-control" name="id_producto" id="producto_select" required>
            <option value="">-- Selecciona un producto --</option>
            @foreach($productos as $producto)
                <option value="{{ $producto->id_producto }}" 
                        data-precio="{{ $producto->precio_unitario }}"
                        {{ old('id_producto') == $producto->id_producto ? 'selected' : '' }}>
                    {{ $producto->id_producto }} - {{ $producto->nombre }} (${{ number_format($producto->precio_unitario, 2) }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion" required>{{ old('descripcion') }}</textarea>
    </div>
    <div class="mb-3">
        <label>Cantidad de Productos</label>
        <input type="number" class="form-control" name="cantidad_productos" value="{{ old('cantidad_productos') }}" min="1" required>
    </div>
    <div class="mb-3">
        <label>Precio Unitario</label>
        <input type="number" step="0.01" class="form-control" name="precio_unitario" id="precio_unitario" value="{{ old('precio_unitario') }}" min="0" required>
        <small class="form-text text-muted">Se completa automáticamente al seleccionar un producto</small>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ $venta_id ? route('admin.detalles.porVenta', $venta_id) : route('admin.detalles.index') }}" class="btn btn-secondary">Cancelar</a>

</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productoSelect = document.getElementById('producto_select');
    const precioInput = document.getElementById('precio_unitario');
    const descripcionTextarea = document.getElementById('descripcion');
    
    productoSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            // Auto-completar precio
            const precio = selectedOption.getAttribute('data-precio');
            precioInput.value = precio;
            
            // Auto-completar descripción con el nombre del producto
            const nombreProducto = selectedOption.text.split(' - ')[1].split(' ($')[0];
            if (!descripcionTextarea.value) {
                descripcionTextarea.value = nombreProducto;
            }
        } else {
            precioInput.value = '';
        }
    });
});
</script>
@endsection