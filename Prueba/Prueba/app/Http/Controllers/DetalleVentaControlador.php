<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DetalleVentaControlador extends Controller
{
    public function porVenta($ventaId): View
    {
        $venta = Venta::with('usuario')->findOrFail($ventaId);
        $detalles = DetalleVenta::with('producto')->where('id_venta', $ventaId)->get();
        
        $usuario = auth()->user();
        
        // Determinar la vista según el rol del usuario
        if ($usuario->role === 'admin') {
            return view('empleados.detalles.porVenta', compact('venta', 'detalles'));
        } elseif ($usuario->role === 'empleado') {
            return view('empleado.detalles.porVenta', compact('venta', 'detalles'));
        }
        
        // Por defecto, vista de admin
        return view('empleados.detalles.porVenta', compact('venta', 'detalles'));
    }

    public function index(): View
    {
        $detalleVenta = DetalleVenta::with('producto', 'venta')->get();
        return view('empleados.detalles.index', compact('detalleVenta'));
    }

    public function create(Request $request): View
    {
        $productos = Producto::all();
        $venta_id = $request->get('venta_id');
        
        return view('empleados.detalles.create', compact('productos', 'venta_id'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:venta,id_venta',
            'id_producto' => 'required|exists:producto,id_producto',
            'descripcion' => 'required|string',
            'cantidad_productos' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        $detalle = DetalleVenta::create($validated);

        return redirect()
            ->route('admin.detalles.porVenta', ['venta' => $detalle->id_venta])
            ->with('success', 'Detalle de venta creado correctamente.');
    }

    public function show(string $id): View
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        return view('empleados.detalles.show', compact('detalleVenta'));
    }

    public function edit(DetalleVenta $detalle): View
    {
        return view('empleados.detalles.edit', compact('detalle'));
    }

    public function update(Request $request, DetalleVenta $detalle): RedirectResponse
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:venta,id_venta',
            'id_producto' => 'required|exists:producto,id_producto',
            'descripcion' => 'required|string',
            'cantidad_productos' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        $detalle->update($validated);

        return redirect()
            ->route('admin.detalles.porVenta', ['venta' => $detalle->id_venta])
            ->with('success', 'Detalle de venta actualizado exitosamente.');
    }

    public function destroy(DetalleVenta $detalle): RedirectResponse
    {
        $ventaId = $detalle->id_venta;
        $detalle->delete();

        return redirect()
            ->route('admin.detalles.porVenta', ['venta' => $ventaId])
            ->with('success', 'Detalle de venta eliminado correctamente.');
    }
}
