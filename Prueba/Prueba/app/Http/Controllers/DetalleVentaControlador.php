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

    public function index(Request $request): View
    {
        // Construir query base
        $query = DetalleVenta::with(['producto', 'venta']);

        // Aplicar filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('descripcion', 'like', "%{$search}%")
                  ->orWhereHas('producto', function($productoQuery) use ($search) {
                      $productoQuery->where('nombre', 'like', "%{$search}%");
                  })
                  ->orWhereHas('venta', function($ventaQuery) use ($search) {
                      $ventaQuery->where('id_venta', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('id_venta')) {
            $query->where('id_venta', $request->id_venta);
        }

        if ($request->filled('id_producto')) {
            $query->where('id_producto', $request->id_producto);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio_unitario', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio_unitario', '<=', $request->precio_max);
        }

        if ($request->filled('cantidad_min')) {
            $query->where('cantidad_productos', '>=', $request->cantidad_min);
        }

        if ($request->filled('cantidad_max')) {
            $query->where('cantidad_productos', '<=', $request->cantidad_max);
        }

        $detalleVenta = $query->orderBy('id_detalleV', 'desc')->get();
        return view('empleados.detalles.index', compact('detalleVenta'));
    }

    public function create(Request $request): View
    {
        $productos = Producto::all();
        $venta_id = $request->get('venta_id');
        
        return view('empleados.detalles.create', compact('productos', 'venta_id'));
    }

    public function createMultiple(Request $request): View
    {
        $productos = Producto::all();
        $venta_id = $request->get('venta_id');
        $usuario = auth()->user();
        
        if ($usuario->role === 'admin') {
            return view('empleados.detalles.createMultiple', compact('productos', 'venta_id'));
        } elseif ($usuario->role === 'empleado') {
            return view('empleado.detalles.createMultiple', compact('productos', 'venta_id'));
        }
        
        abort(403, 'Acceso denegado');
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

    public function storeMultiple(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_venta' => 'required|exists:venta,id_venta',
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|exists:producto,id_producto',
            'productos.*.cantidad_productos' => 'required|numeric|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
            'productos.*.descripcion' => 'required|string'
        ]);

        $detallesCreados = [];
        
        foreach ($validated['productos'] as $productoData) {
            $detalle = DetalleVenta::create([
                'id_venta' => $validated['id_venta'],
                'id_producto' => $productoData['id_producto'],
                'cantidad_productos' => $productoData['cantidad_productos'],
                'precio_unitario' => $productoData['precio_unitario'],
                'descripcion' => $productoData['descripcion']
            ]);
            
            $detallesCreados[] = $detalle;
        }

        $cantidadProductos = count($detallesCreados);
        $usuario = auth()->user();
        
        if ($usuario->role === 'admin') {
            return redirect()
                ->route('admin.detalles.porVenta', ['venta' => $validated['id_venta']])
                ->with('success', "Se agregaron {$cantidadProductos} productos a la venta correctamente.");
        } elseif ($usuario->role === 'empleado') {
            return redirect()
                ->route('empleado.detalles.porVenta', ['venta' => $validated['id_venta']])
                ->with('success', "Se agregaron {$cantidadProductos} productos a la venta correctamente.");
        }
        
        abort(403, 'Acceso denegado');
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
