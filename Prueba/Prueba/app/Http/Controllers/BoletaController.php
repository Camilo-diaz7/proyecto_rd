<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoletaController extends Controller
{
    public function index()
    {
        $boletas = Boleta::with('evento','user')->where('id', Auth::id())->get();
        return view('cliente.boletas.index', compact('boletas'));
    }

     public function create()
    {
        // Clientes
        $usuarios = User::where('role', 'Cliente')->get();

        // Eventos
        $eventos = Evento::all();

        return view('cliente.boletas.create', compact('usuarios', 'eventos'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_evento'        => 'required|exists:evento,id_evento',
        'cantidad_boletos' => 'required|integer|min:1',
    ]);

    Boleta::create([
        'id_evento'        => $request->id_evento,
        'id'               => Auth::id(), // usar siempre el usuario autenticado
        'cantidad_boletos' => $request->cantidad_boletos,
        'precio_boleta'    => $request->precio_boleta, // opcional
    ]);

    return redirect()
        ->route('cliente.boletas.index')->with('success', 'Boleta creada correctamente 🎉');
}
    public function edit(Boleta $boleta)
    {
        // Verificar que la boleta pertenezca al usuario autenticado
        if ($boleta->id !== Auth::id()) {
            abort(403, 'No tienes permisos para editar esta boleta.');
        }
        
        $usuarios = User::all();
        $eventos = Evento::all();
        return view('cliente.boletas.edit', compact('boleta','usuarios','eventos'));
    }

    public function update(Request $request, Boleta $boleta)
    {
        // Verificar que la boleta pertenezca al usuario autenticado
        if ($boleta->id !== Auth::id()) {
            abort(403, 'No tienes permisos para actualizar esta boleta.');
        }
        
        $request->validate([
            'id_evento'        => 'required|exists:evento,id_evento',
            'cantidad_boletos' => 'required|integer|min:1'
        ]);

        $boleta->update([
            'id_evento'        => $request->id_evento,
            'cantidad_boletos' => $request->cantidad_boletos,
        ]);

        return redirect()->route('cliente.boletas.index')->with('success','Boleta actualizada correctamente.');
    }

    public function destroy(Boleta $boleta)
    {
        // Verificar que la boleta pertenezca al usuario autenticado
        if ($boleta->id !== Auth::id()) {
            abort(403, 'No tienes permisos para eliminar esta boleta.');
        }
        
        $boleta->delete();

        return redirect()->route('cliente.boletas.index')->with('success','Boleta eliminada correctamente.');
    }
}