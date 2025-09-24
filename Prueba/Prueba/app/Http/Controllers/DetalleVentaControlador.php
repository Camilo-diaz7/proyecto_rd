<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DetalleVentaControlador extends Controller
{
    public function porVenta($ventaId): View
    {
        $venta = Venta::findOrFail($ventaId);
        $detalles = DetalleVenta::where('id_venta', $ventaId)->get();
        return view('detalles.porVenta', compact('venta', 'detalles'));
    }

    public function index(): View
    {
        $detalleVenta = DetalleVenta::all();
        return view('empleados.detalles.index', compact('detalleVenta'));
    }

    public function create(): View
    {
        return view('empleados.detalles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'descripcion' => 'required|string',
            'cantidad_productos' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        $detalle = DetalleVenta::create($validated);

        return redirect()
            ->route('detalles.porVenta', ['venta' => $detalle->id_venta])
            ->with('success', 'Detalle de venta creado correctamente.');
    }

    public function show(string $id): View
    {
        $detalleVenta = DetalleVenta::findOrFail($id);
        return view('detalles.show', compact('detalleVenta'));
    }

    public function edit(DetalleVenta $detalle): View
    {
        return view('empleados.detalles.edit', compact('detalle'));
    }

    public function update(Request $request, DetalleVenta $detalle): RedirectResponse
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:ventas,id_venta',
            'id_producto' => 'required|exists:productos,id_producto',
            'descripcion' => 'required|string',
            'cantidad_productos' => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0'
        ]);

        $detalle->update($validated);

        return redirect()
            ->route('detalles.porVenta', ['venta' => $detalle->id_venta])
            ->with('success', 'Detalle de venta actualizado exitosamente.');
    }

    public function destroy(DetalleVenta $detalle): RedirectResponse
    {
        $ventaId = $detalle->id_venta;
        $detalle->delete();

        return redirect()
            ->route('detalles.porVenta', ['venta' => $ventaId])
            ->with('success', 'Detalle de venta eliminado correctamente.');
    }
}
