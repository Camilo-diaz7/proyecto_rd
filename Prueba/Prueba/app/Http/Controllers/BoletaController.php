<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoletaController extends Controller
{
    public function index(Request $request)
    {
        $usuario = Auth::user();
        
        if($usuario->role === 'admin'){
            // Admin ve todas las boletas del sistema con filtros
            $query = Boleta::with('evento','user');
            
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('id_boleta', 'like', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('apellido', 'like', "%{$search}%")
                                   ->orWhere('numero_documento', 'like', "%{$search}%");
                      })
                      ->orWhereHas('evento', function($eventoQuery) use ($search) {
                          $eventoQuery->where('nombre_evento', 'like', "%{$search}%");
                      });
                });
            }
            
            if ($request->filled('id_evento')) {
                $query->where('id_evento', $request->id_evento);
            }
            
            if ($request->filled('cantidad_min')) {
                $query->where('cantidad_boletos', '>=', $request->cantidad_min);
            }
            
            if ($request->filled('cantidad_max')) {
                $query->where('cantidad_boletos', '<=', $request->cantidad_max);
            }
            
            $boletas = $query->orderBy('id_boleta', 'desc')->get();
            return view('empleados.boletas.index', compact('boletas'));
        }

        if($usuario->role === 'cliente'){
            // Cliente ve solo sus propias boletas con filtros
            $query = Boleta::with('evento','user')->where('id', Auth::id());
            
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('id_boleta', 'like', "%{$search}%")
                      ->orWhereHas('evento', function($eventoQuery) use ($search) {
                          $eventoQuery->where('nombre_evento', 'like', "%{$search}%");
                      });
                });
            }
            
            if ($request->filled('id_evento')) {
                $query->where('id_evento', $request->id_evento);
            }
            
            $boletas = $query->orderBy('id_boleta', 'desc')->get();
            return view('cliente.boletas.index', compact('boletas'));
        }

        if($usuario->role === 'empleado'){
            // Empleado ve todas las boletas del sistema con filtros
            $query = Boleta::with('evento','user');
            
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('id_boleta', 'like', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('apellido', 'like', "%{$search}%")
                                   ->orWhere('numero_documento', 'like', "%{$search}%");
                      })
                      ->orWhereHas('evento', function($eventoQuery) use ($search) {
                          $eventoQuery->where('nombre_evento', 'like', "%{$search}%");
                      });
                });
            }
            
            if ($request->filled('id_evento')) {
                $query->where('id_evento', $request->id_evento);
            }
            
            $boletas = $query->orderBy('id_boleta', 'desc')->get();
            return view('empleado.boletas.index', compact('boletas'));
        }

        abort(403, 'Acceso denegado');
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