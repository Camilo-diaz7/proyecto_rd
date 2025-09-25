<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class EmpleadoController extends Controller
{
    /**
     * Listar empleados y clientes.
     */
  public function index()
{
    $empleados = User::where('role', 'empleado')->get();
    $clientes = User::where('role', 'cliente')->get();

    return view('empleados.index', compact('empleados', 'clientes'));
}

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Guardar un nuevo empleado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'apellido'         => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:6',
            'role'             => 'required|string',
            'tipo_documento'   => 'nullable|string',
            'numero_documento' => 'nullable|string|unique:users,numero_documento',
            'telefono'         => 'nullable|string',
        ]);

        User::create([
            'name'             => $request->name,
            'apellido'         => $request->apellido,
            'email'            => $request->email,
            'password'         => bcrypt($request->password),
            'role'             => $request->role,
            'tipo_documento'   => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'telefono'         => $request->telefono,
        ]);

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado creado correctamente ✅');
    }

    /**
     * Mostrar un empleado.
     */
    public function show(User $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Formulario para editar un empleado.
     */
    public function edit(User $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Actualizar un empleado.
     */
    public function update(Request $request, User $empleado)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'apellido'         => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $empleado->id,
            'numero_documento' => 'required|string|unique:users,numero_documento,' . $empleado->id,
            'telefono'         => 'nullable|string',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado actualizado correctamente ✅');
    }

    /**
     * Eliminar un empleado.
     */
    public function destroy(User $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado eliminado correctamente ❌');
    }
}
