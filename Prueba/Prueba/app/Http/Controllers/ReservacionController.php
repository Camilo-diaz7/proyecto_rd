<?php
namespace App\Http\Controllers;

use App\Models\Reservacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
{
    public function index(Request $request)
    {
        $usuario = Auth::user();

        if ($usuario->role === 'cliente') {
            // Reservaciones solo de ese cliente con filtros
            $query = Reservacion::where('id', $usuario->id);
            
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('ocasion', 'like', "%{$search}%");
                });
            }
            
            if ($request->filled('fecha_desde')) {
                $query->whereDate('fecha_reservacion', '>=', $request->fecha_desde);
            }
            
            if ($request->filled('fecha_hasta')) {
                $query->whereDate('fecha_reservacion', '<=', $request->fecha_hasta);
            }
            
            if ($request->filled('personas_min')) {
                $query->where('cantidad_personas', '>=', $request->personas_min);
            }
            
            if ($request->filled('personas_max')) {
                $query->where('cantidad_personas', '<=', $request->personas_max);
            }
            
            $reservaciones = $query->orderBy('fecha_reservacion', 'desc')->get();
            return view('cliente.reservaciones.index', compact('reservaciones'));
        }

        if ($usuario->role === 'empleado') {
            $query = Reservacion::with('user');
            
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('ocasion', 'like', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('apellido', 'like', "%{$search}%")
                                   ->orWhere('numero_documento', 'like', "%{$search}%");
                      });
                });
            }
            
            if ($request->filled('fecha_desde')) {
                $query->whereDate('fecha_reservacion', '>=', $request->fecha_desde);
            }
            
            if ($request->filled('fecha_hasta')) {
                $query->whereDate('fecha_reservacion', '<=', $request->fecha_hasta);
            }
            
            if ($request->filled('personas_min')) {
                $query->where('cantidad_personas', '>=', $request->personas_min);
            }
            
            if ($request->filled('personas_max')) {
                $query->where('cantidad_personas', '<=', $request->personas_max);
            }
            
            $reservaciones = $query->orderBy('fecha_reservacion', 'desc')->get();
            return view('empleado.reservaciones.index', compact('reservaciones'));
        }

        if ($usuario->role === 'admin') {
            $query = Reservacion::with('user');
            
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('ocasion', 'like', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('apellido', 'like', "%{$search}%")
                                   ->orWhere('numero_documento', 'like', "%{$search}%");
                      });
                });
            }
            
            if ($request->filled('fecha_desde')) {
                $query->whereDate('fecha_reservacion', '>=', $request->fecha_desde);
            }
            
            if ($request->filled('fecha_hasta')) {
                $query->whereDate('fecha_reservacion', '<=', $request->fecha_hasta);
            }
            
            if ($request->filled('personas_min')) {
                $query->where('cantidad_personas', '>=', $request->personas_min);
            }
            
            if ($request->filled('personas_max')) {
                $query->where('cantidad_personas', '<=', $request->personas_max);
            }
            
            $reservaciones = $query->orderBy('fecha_reservacion', 'desc')->get();
            return view('empleados.reservaciones.index', compact('reservaciones'));
        }

        abort(403, 'Acceso denegado');
    }

    public function create()
    {
        return view('cliente.reservaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cantidad_personas' => 'required|integer|min:1',
            'cantidad_mesas' => 'required|integer|min:1',
            'fecha_reservacion' => 'required|date',
            'ocasion' => 'nullable|string|max:255',
        ]);

        $reservacion = new Reservacion();
            $reservacion->id = Auth::id(); // guarda el usuario autenticado
        $reservacion->cantidad_personas = $request->cantidad_personas;
        $reservacion->cantidad_mesas = $request->cantidad_mesas;
        $reservacion->fecha_reservacion = $request->fecha_reservacion;
        $reservacion->ocasion = $request->ocasion;
        $reservacion->save();

        return redirect()->route('cliente.reservaciones.index')
                         ->with('success', 'Reservación creada correctamente');
    }

    public function edit(Reservacion $reservacione)
    {
        return view('cliente.reservaciones.edit', compact('reservacione'));
    }

    public function update(Request $request, Reservacion $reservacione)
    {
        $request->validate([
            'cantidad_personas' => 'required|integer|min:1',
            'cantidad_mesas' => 'required|integer|min:1',
            'fecha_reservacion' => 'required|date',
            'ocasion' => 'nullable|string|max:255',
        ]);

        $reservacione->update($request->only([
            'cantidad_personas',
            'cantidad_mesas',
            'fecha_reservacion',
            'ocasion'
        ]));

        return redirect()->route('cliente.reservaciones.index')
                         ->with('success', 'Reservación actualizada correctamente');
    }

    public function destroy(Reservacion $reservacione)
    {
        $reservacione->delete();
        return redirect()->route('cliente.reservaciones.index')
                         ->with('success', 'Reservación eliminada correctamente');
    }
}
