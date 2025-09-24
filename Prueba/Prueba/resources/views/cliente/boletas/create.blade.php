@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Crear Boleta</h2>
    <form action="{{ route('cliente.boletas.store') }}" method="POST" class="p-4 bg-light rounded shadow-sm">
        @csrf

        <!-- Selección de Usuario -->
        <!-- Ya no es necesario enviar el ID del usuario -->

        <div class="mb-3">
            <label for="id" class="form-label">ID Usuario</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
            <input type="hidden" name="id" value="{{ Auth::id() }}">
        </div>

        <!-- Selección de Evento -->
        <div class="mb-3">
            <label for="id_evento" class="form-label">Evento</label>
            <select name="id_evento" id="id_evento" class="form-select" required>
                @foreach($eventos as $evento)
                    <option value="{{ $evento->id_evento }}" data-precio="{{ $evento->precio_boleta }}">
                        {{ $evento->nombre_evento }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo oculto para precio -->
        <input type="hidden" name="precio_boleta" id="precio_boleta">

        <!-- Mostrar precio al usuario -->
        <div class="mb-3">
            <label for="precio" class="form-label">Precio por Boleta</label>
            <input type="text" id="precio" class="form-control" readonly>
        </div>

        <!-- Cantidad de boletos -->
        <div class="mb-3">
            <label for="cantidad_boletos" class="form-label">Cantidad</label>
            <input type="number" name="cantidad_boletos" id="cantidad_boletos" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-danger w-100">Guardar Boleta</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const selectEvento = document.getElementById("id_evento");
    const inputPrecio = document.getElementById("precio");
    const hiddenPrecio = document.getElementById("precio_boleta");

    function actualizarPrecio() {
        const precio = selectEvento.options[selectEvento.selectedIndex].getAttribute("data-precio");
        inputPrecio.value = precio ? `$ ${precio}` : "";
        hiddenPrecio.value = precio;
    }

    selectEvento.addEventListener("change", actualizarPrecio);
    actualizarPrecio();
});
</script>
@endsection





