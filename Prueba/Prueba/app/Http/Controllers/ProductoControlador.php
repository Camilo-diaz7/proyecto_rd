<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        if (auth()->user()->hasRole('empleado')) {
            return view('empleados.productos.index', compact('productos'));
        } else {
            return view('empleado.productos.index', compact('productos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_producto' => 'required|string|max:50',
            'stock' => 'required|numeric|min:0',
            'precio_unitario' => 'required|integer|min:0'
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('empleados.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo_producto' => 'required|string|max:50',
            'stock' => 'required|numeric|min:0',
            'precio_unitario' => 'required|integer|min:0'
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
