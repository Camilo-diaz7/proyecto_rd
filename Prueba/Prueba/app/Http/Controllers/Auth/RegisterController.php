<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirección por defecto (no se usará porque sobrescribimos registered).
     */
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validador de datos del registro.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo_documento' => ['required', 'string', 'max:20'],
            'numero_documento' => ['required', 'numeric', 'digits_between:6,12', 'unique:users,numero_documento'],
        ]);
    }

    /**
     * Crear el usuario.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellido'=>$data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // ✅ ahora usa la contraseña del form
            'role' => 'cliente',
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],
        ]);
    }

    /**
     * Después del registro → cerrar sesión → mandar al login.
     */
    protected function registered($request, $user)
    {
          $this->guard()->logout();
        return redirect()->route('login')->with('success', '✅ Usuario registrado, ahora inicia sesión.');
    }
}
