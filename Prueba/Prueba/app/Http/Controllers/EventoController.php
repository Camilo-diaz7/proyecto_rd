<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    

    public function index()
    {
        $eventos = Evento::all();
        return redirect()->route('cliente.eventos.index')->with('success', 'Evento creado con éxito');

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
        return view('cliente.eventos.show', compact('evento'));
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

        return redirect()->route('cliente.eventos.index')->with('success', 'Evento creado con éxito');
    }


    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('cliente.eventos.edit', compact('evento'));
    }


   public function update(Request $request, Evento $evento)
{
    $request->validate([
        'nombre_evento' => 'required|string|max:100',
        'capacidad_maxima' => 'required|integer',
        'descripcion' => 'nullable|string',
        'fecha' => 'required|date',
        'hora_inicio' => 'required',
        'precio_boleta' => 'required|numeric',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Subir nueva imagen si existe
    if ($request->hasFile('imagen')) {
        // Eliminar imagen anterior si existe
        if ($evento->imagen && file_exists(storage_path('app/public/' . $evento->imagen))) {
            unlink(storage_path('app/public/' . $evento->imagen));
        }

        // Guardar la nueva imagen
        $path = $request->file('imagen')->store('eventos', 'public');
        $data['imagen'] = $path;
    }

    $evento->update($data);

    return redirect()->route('cliente.eventos.index')->with('success', 'Evento actualizado correctamente');
}




    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}

