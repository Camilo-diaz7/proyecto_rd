@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="h4 mb-3">Agregar Múltiples Productos</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>       
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.detalles.storeMultiple') }}" method="POST" id="multipleProductsForm">
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

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Productos Seleccionados</h5>
                <button type="button" class="btn btn-success btn-sm" onclick="addProductRow()">
                    <i class="fas fa-plus"></i> Agregar Producto
                </button>
            </div>
            <div class="card-body">
                <div id="productsContainer">
                    <!-- Las filas de productos se agregarán aquí dinámicamente -->
                </div>
                
                <div class="text-center mt-3" id="noProductsMessage">
                    <p class="text-muted">No hay productos seleccionados. Haz clic en "Agregar Producto" para comenzar.</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Resumen de la Venta</h6>
                        <p><strong>Total de productos:</strong> <span id="totalProducts">0</span></p>
                        <p><strong>Total a pagar:</strong> <span id="totalAmount" class="text-success font-weight-bold">$0.00</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                <i class="fas fa-save"></i> Guardar Productos
            </button>
            <a href="{{ route('admin.detalles.porVenta', ['venta' => $venta_id]) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<!-- Modal para seleccionar productos -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccionar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id_producto }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->tipo_producto }}</td>
                                <td>${{ number_format($producto->precio_unitario, 2) }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" 
                                            onclick="selectProduct({{ $producto->id_producto }}, '{{ $producto->nombre }}', {{ $producto->precio_unitario }})">
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let productRowIndex = 0;
let selectedProducts = new Set();

function addProductRow() {
    productRowIndex++;
    const container = document.getElementById('productsContainer');
    const noProductsMessage = document.getElementById('noProductsMessage');
    
    // Ocultar mensaje de no productos
    noProductsMessage.style.display = 'none';
    
    const rowHtml = `
        <div class="row mb-3 product-row" id="productRow${productRowIndex}">
            <div class="col-md-4">
                <label class="form-label">Producto</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="productName${productRowIndex}" readonly placeholder="Seleccionar producto">
                    <input type="hidden" name="productos[${productRowIndex}][id_producto]" id="productId${productRowIndex}">
                    <button type="button" class="btn btn-outline-primary" onclick="openProductModal(${productRowIndex})">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="productos[${productRowIndex}][cantidad_productos]" 
                       min="1" value="1" onchange="updateTotals()" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Precio Unit.</label>
                <input type="number" class="form-control" name="productos[${productRowIndex}][precio_unitario]" 
                       step="0.01" min="0" onchange="updateTotals()" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Descripción</label>
                <input type="text" class="form-control" name="productos[${productRowIndex}][descripcion]" 
                       placeholder="Descripción del producto" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeProductRow(${productRowIndex})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', rowHtml);
    updateTotals();
}

function removeProductRow(index) {
    const row = document.getElementById(`productRow${index}`);
    if (row) {
        const productId = document.getElementById(`productId${index}`).value;
        if (productId) {
            selectedProducts.delete(productId);
        }
        row.remove();
        updateTotals();
        
        // Mostrar mensaje si no hay productos
        const container = document.getElementById('productsContainer');
        if (container.children.length === 0) {
            document.getElementById('noProductsMessage').style.display = 'block';
        }
    }
}

function openProductModal(rowIndex) {
    window.currentRowIndex = rowIndex;
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();
}

function selectProduct(id, name, price) {
    const rowIndex = window.currentRowIndex;
    const productIdInput = document.getElementById(`productId${rowIndex}`);
    const productNameInput = document.getElementById(`productName${rowIndex}`);
    const priceInput = document.querySelector(`input[name="productos[${rowIndex}][precio_unitario]"]`);
    
    // Verificar si el producto ya está seleccionado
    if (selectedProducts.has(id.toString())) {
        alert('Este producto ya ha sido seleccionado.');
        return;
    }
    
    productIdInput.value = id;
    productNameInput.value = `${id} - ${name}`;
    priceInput.value = price;
    
    selectedProducts.add(id.toString());
    
    // Cerrar modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
    modal.hide();
    
    updateTotals();
}

function updateTotals() {
    let totalProducts = 0;
    let totalAmount = 0;
    
    const rows = document.querySelectorAll('.product-row');
    rows.forEach(row => {
        const cantidadInput = row.querySelector('input[name*="[cantidad_productos]"]');
        const precioInput = row.querySelector('input[name*="[precio_unitario]"]');
        
        if (cantidadInput && precioInput && cantidadInput.value && precioInput.value) {
            const cantidad = parseInt(cantidadInput.value) || 0;
            const precio = parseFloat(precioInput.value) || 0;
            
            totalProducts += cantidad;
            totalAmount += cantidad * precio;
        }
    });
    
    document.getElementById('totalProducts').textContent = totalProducts;
    document.getElementById('totalAmount').textContent = `$${totalAmount.toFixed(2)}`;
    
    // Habilitar/deshabilitar botón de envío
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = rows.length === 0 || totalProducts === 0;
}

// Inicializar con una fila de producto
document.addEventListener('DOMContentLoaded', function() {
    addProductRow();
});
</script>
@endsection
