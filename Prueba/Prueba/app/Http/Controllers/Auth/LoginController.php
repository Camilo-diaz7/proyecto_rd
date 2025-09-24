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
    if ($user->role === 'admin') {
        return redirect()->route('empleados.index'); // ✅ admin → lista de empleados
    }

    if ($user->role === 'empleado') {
        return redirect()->route('empleado.empl'); // empleado → su vista
    }

    if ($user->role === 'cliente') {
        return redirect()->route('cliente.dashboard'); // cliente → dashboard cliente
    }
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
