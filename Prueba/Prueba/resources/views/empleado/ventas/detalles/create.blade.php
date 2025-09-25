@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Nuevo Detalle de Venta</h1>

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
            <label>Venta</label>
            <select class="form-control" name="id_venta" required>
                <option value="">-- Selecciona una venta --</option>
                @foreach(\App\Models\Venta::with('usuario')->get() as $venta)
                    <option value="{{ $venta->id_venta }}" {{ old('id_venta') == $venta->id_venta ? 'selected' : '' }}>
                        Venta #{{ $venta->id_venta }} - {{ $venta->usuario ? $venta->usuario->name : 'Sin usuario' }} - ${{ number_format($venta->total, 3) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Producto</label>
            <select class="form-control" name="id_producto" required>
                <option value="">-- Selecciona un producto --</option>
                @foreach(\App\Models\Producto::all() as $producto)
                    <option value="{{ $producto->id_producto }}" {{ old('id_producto') == $producto->id_producto ? 'selected' : '' }}>
                        ID: {{ $producto->id_producto }} - {{ $producto->nombre }} ({{ $producto->tipo_producto }}) - ${{ number_format($producto->precio_unitario, 3) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Cantidad</label>
            <input class="form-control" type="number" name="cantidad_productos" value="{{ old('cantidad_productos') }}" min="1" required>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input class="form-control" type="number" step="0.01" name="precio_unitario" value="{{ old('precio_unitario') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.detalles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
document.getElementById('id_producto').addEventListener('change', function() {
    const productoId = this.value;
    if (productoId) {
        // Aquí podrías hacer una petición AJAX para obtener el precio del producto
        // Por ahora, mostraremos un mensaje
        const selectedOption = this.options[this.selectedIndex];
        const precioText = selectedOption.text.match(/\$([\d,]+\.?\d*)/);
        if (precioText) {
            document.getElementById('precio_unitario').value = precioText[1].replace(',', '');
        }
    }
});
</script>
@endsection