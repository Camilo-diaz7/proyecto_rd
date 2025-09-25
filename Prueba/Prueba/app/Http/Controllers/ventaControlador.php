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
    public function index()
     {
    $usuario = Auth::user();

    if ($usuario->role === 'empleado') {
        // Todas las ventas
        $ventas = Venta::with('usuario')->get();
        return view('empleado.ventas.index', compact('ventas'));
    }
    if($usuario->role=='admin'){
        $ventas = Venta::with('usuario')->get();
        return view('empleados.ventas.index',compact('ventas'));
    }

    abort(403, 'Acceso denegado');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //formulario donde estan los campos a registrar
        return view('empleados.ventas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'total'        => 'required|numeric|min:0',
        'metodo_pago'  => 'required|in:efectivo,tarjeta,transferencia',
    ]);

    // Asignar automáticamente el usuario logueado
   $validated['id'] = $request->user()->id;


    Venta::create($validated);

    return redirect()->route('empleados.ventas.index')
        ->with('success','Registro exitoso de la venta');
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
        return view('empleados.ventas.edit', compact('venta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
        ]);

        $venta->update($validated);
        return redirect()->route('admin.ventas.index')
                        ->with('success', 'Registro actualizado de la venta');
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
