<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ventaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     {
    $usuario = Auth::user();

    // Construir query base
    $query = Venta::with(['usuario', 'detalle_venta']);

    // Aplicar filtros
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('id_venta', 'like', "%{$search}%")
              ->orWhere('metodo_pago', 'like', "%{$search}%")
              ->orWhereHas('usuario', function($userQuery) use ($search) {
                  $userQuery->where('name', 'like', "%{$search}%")
                           ->orWhere('apellido', 'like', "%{$search}%")
                           ->orWhere('numero_documento', 'like', "%{$search}%");
              });
        });
    }

    if ($request->filled('metodo_pago')) {
        $query->where('metodo_pago', $request->metodo_pago);
    }

    if ($request->filled('fecha_desde')) {
        $query->whereDate('fecha', '>=', $request->fecha_desde);
    }

    if ($request->filled('fecha_hasta')) {
        $query->whereDate('fecha', '<=', $request->fecha_hasta);
    }

    if ($request->filled('total_min')) {
        $query->where('total', '>=', $request->total_min);
    }

    if ($request->filled('total_max')) {
        $query->where('total', '<=', $request->total_max);
    }

    $ventas = $query->orderBy('fecha', 'desc')->get();

    if ($usuario->role === 'empleado') {
        return view('empleado.ventas.index', compact('ventas'));
    }
    if($usuario->role=='admin'){
        return view('empleados.ventas.index',compact('ventas'));
    }

    abort(403, 'Acceso denegado');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = Auth::user();
        
        if ($usuario->role === 'empleado') {
            return view('empleado.ventas.create');
        }
        if ($usuario->role === 'admin') {
            return view('empleados.ventas.create');
        }
        
        abort(403, 'Acceso denegado');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'metodo_pago'  => 'required|in:efectivo,tarjeta,transferencia',
    ]);

    // Asignar automáticamente el usuario logueado
    $validated['id'] = $request->user()->id;
    
    // Inicializar el total en 0 - se calculará automáticamente cuando se agreguen detalles
    $validated['total'] = 0;

    $venta = Venta::create($validated);

    $usuario = Auth::user();
    
    if ($usuario->role === 'admin') {
        return redirect()->route('admin.ventas.index')
            ->with('success','Registro exitoso de la venta. Ahora puedes agregar detalles para calcular el total automáticamente.');
    } else {
        return redirect()->route('empleado.ventas.index')
            ->with('success','Registro exitoso de la venta. Ahora puedes agregar detalles para calcular el total automáticamente.');
    }
}




    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        return view('empleados.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        $usuario = Auth::user();
        
        if ($usuario->role === 'empleado') {
            return view('empleado.ventas.edit', compact('venta'));
        }
        if ($usuario->role === 'admin') {
            return view('empleados.ventas.edit', compact('venta'));
        }
        
        abort(403, 'Acceso denegado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        $validated = $request->validate([
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
        ]);

        $venta->update($validated);
        
        // Recalcular el total después de actualizar
        $venta->actualizarTotal();
        
        $usuario = Auth::user();
        
        if ($usuario->role === 'admin') {
            return redirect()->route('admin.ventas.index')
                ->with('success', 'Venta actualizada. El total se ha recalculado automáticamente.');
        } else {
            return redirect()->route('empleado.ventas.index')
                ->with('success', 'Venta actualizada. El total se ha recalculado automáticamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        
        $usuario = Auth::user();
        if ($usuario->role === 'admin') {
            return redirect()->route('admin.ventas.index')->with('success', 'Venta eliminada exitosamente');
        } else {
            return redirect()->route('empleado.ventas.index')->with('success', 'Venta eliminada exitosamente');
        }
    }

}
