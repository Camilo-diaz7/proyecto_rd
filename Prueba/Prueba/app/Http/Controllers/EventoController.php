<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    

    public function index(Request $request)
    {
        // Construir query base
        $query = Evento::query();

        // Aplicar filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre_evento', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio_boleta', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio_boleta', '<=', $request->precio_max);
        }

        if ($request->filled('capacidad_min')) {
            $query->where('capacidad_maxima', '>=', $request->capacidad_min);
        }

        if ($request->filled('capacidad_max')) {
            $query->where('capacidad_maxima', '<=', $request->capacidad_max);
        }

        if ($request->filled('eventos_pasados')) {
            $query->whereDate('fecha', '<', now()->toDateString());
        }

        if ($request->filled('eventos_futuros')) {
            $query->whereDate('fecha', '>=', now()->toDateString());
        }

        $eventos = $query->orderBy('fecha', 'desc')->get();
        return view('empleados.eventos.index', compact('eventos'));
    }
  

    public function mostrarEventos()
{
    $eventos = Evento::all(); // Trae todos los eventos
    return view('home', compact('eventos')); // Pasa los eventos a la vista
}
    public function create()
    {
        return view('empleados.eventos.create');
    }
       public function show (Evento $evento){
        return view('empleados.eventos.show', compact('evento'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'capacidad_maxima' => 'required|integer',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'precio_boleta' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Guardar imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('eventos', 'public');
            $data['imagen'] = $path;
        }

        Evento::create($data);

        return redirect()->route('admin.eventos.index')->with('success', 'Evento creado con éxito');
    }


    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('empleados.eventos.edit', compact('evento'));
    }


   public function update(Request $request, Evento $evento)
{
    $data = $request->validate([
        'nombre_evento' => 'required|string|max:100',
        'capacidad_maxima' => 'required|integer',
        'descripcion' => 'nullable|string',
        'fecha' => 'required|date',
        'hora_inicio' => 'required',
        'precio_boleta' => 'required|numeric',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Subir nueva imagen si existe
    if ($request->hasFile('imagen')) {
        // Eliminar imagen anterior si existe
        if ($evento->imagen && file_exists(storage_path('app/public/' . $evento->imagen))) {
            unlink(storage_path('app/public/' . $evento->imagen));
        }

        // Guardar la nueva imagen
        $path = $request->file('imagen')->store('eventos', 'public');
        $data['imagen'] = $path;
    } else {
        // Si no hay nueva imagen, quitar del array para no sobrescribir
        unset($data['imagen']);
    }

    $evento->update($data);

    return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente');
}




    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}

