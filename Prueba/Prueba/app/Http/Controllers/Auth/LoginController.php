<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirección después del login según el rol.
     */
protected function authenticated(Request $request, $user)
{
    // Debug temporal - mostrar el rol del usuario
    \Log::info('Usuario logueado:', ['id' => $user->id, 'email' => $user->email, 'role' => $user->role]);
    
    if ($user->role === 'admin') {
        return redirect()->route('admin.empleados.index'); // ✅ admin → lista de empleados
    }

    if ($user->role === 'empleado') {
        return redirect()->route('empleado.empl'); // empleado → su vista
    }

    if ($user->role === 'cliente') {
        return redirect()->route('cliente.dashboard'); // cliente → dashboard cliente
    }
    
    // Si no coincide con ningún rol, ir al dashboard por defecto
    \Log::warning('Rol no reconocido:', ['role' => $user->role]);
    return redirect()->route('cliente.dashboard');
}


    public function username()
{
    return 'numero_documento';
}

    /**
     * Ruta por defecto (no se usa porque ya redirigimos arriba).
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
