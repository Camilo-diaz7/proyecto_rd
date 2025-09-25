<?php

namespace App\Http\Controllers;

use App\Models\venta;
use App\Models\User;
use Illuminate\Http\Request;

class ventaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
     {
    $usuario = Auth::user();

    if ($usuario->role === 'empleado') {
        // Todas las reservaciones
        $venta = venta::all();
        return view('empleado.ventas.index', compact('venta'));
    }
    if($usuario->role=='admin'){
        $venta= Venta::all();
        return view('admin.ventas.index',compact('venta'));
    }

    abort(403, 'Acceso denegado');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //formulario donde estan los campos a registrar
        return view('empleado.ventas.create');
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
   $validated['id_usuario'] = $request->user()->id;


    Venta::create($validated);

    return redirect()->route('empleado.ventas.index')
        ->with('success','Registro exitoso de la venta');
}




    /**
     * Display the specified resource.
     */
    public function show(venta $venta)
    {
        //
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(venta $venta)
    {
            return view('ventas.edit', compact('venta'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, venta $venta)
    {
           $validated = $request->validate([
        'total' => 'required|numeric|min:0',
        'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
        ]);

   $venta->update($validated);
        return redirect()->route('ventas.index')->
        with('success','registro actualizado de la venta');
    }
        //

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with
        ('success','eliminado exitosamente');

        //
    }

}


