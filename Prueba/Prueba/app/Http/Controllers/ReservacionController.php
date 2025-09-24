<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
{
    public function index()
    {
        $reservaciones = Reservacion::where('id', Auth::id())->get();
        return view('empleados.reservaciones.index',compact('reservaciones'));
        //lista del producto
    }

    if ($usuario->role === 'empleado') {
        // Todas las reservaciones
        $reservaciones = Reservacion::all();
        return view('empleado.reservaciones.index', compact('reservaciones'));
    }
    if ($usuario->role==="admin"){
        $reservaciones=Reservacion::all();
        return view('admin.reservaciones.index',compact('reservaciones'));
    }

    abort(403, 'Acceso denegado');
}

    public function create()
    {
        //formulario donde estan los campos a registrar
        return view('empleados.reservaciones.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'cantidad_personas' => 'required|integer',
        'cantidad_mesas' => 'required|integer',
        'fecha_reservacion' => 'required|date',
        'ocasion' => 'nullable|string',
    ]);

        $reservacion = new Reservacion();
        $reservacion->cliente_id = Auth::id();
        $reservacion->cantidad_personas = $request->cantidad_personas;
        $reservacion->cantidad_mesas = $request->cantidad_mesas;
        $reservacion->fecha_reservacion = $request->fecha_reservacion;
        $reservacion->ocasion = $request->ocasion;
        $reservacion->save();

        return redirect()->route('cliente.reservaciones.index')
                         ->with('success', 'Reservación creada correctamente');
    }

    public function show(Reservacion $reservacion)
    {
        return view('cliente.reservaciones.show', compact('reservacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Reservacion $reservacion)
{
    return view('empleados.reservaciones.edit', compact('reservacion'));
}

    public function update(Request $request, Reservacion $reservacion)
{
    // Validación de los campos que sí existen
    $request->validate([
        'cantidad_personas' => 'required|integer|min:1',
        'cantidad_mesas' => 'required|integer|min:1',
        'fecha_reservacion' => 'required|date',
        'ocasion' => 'required|string|max:255',
    ]);

    // Actualizar solo los campos permitidos
    $reservacion->update($request->only([
        'cantidad_personas',
        'cantidad_mesas',
        'fecha_reservacion',
        'ocasion'
    ]));

        return redirect()->route('cliente.reservaciones.index')
                         ->with('success', 'Reservación actualizada correctamente');
    }

    public function destroy(Reservacion $reservacion)
    {
        $reservacion->delete();

        return redirect()->route('cliente.reservaciones.index')
                         ->with('success', 'Reservación eliminada correctamente');
    }
}
