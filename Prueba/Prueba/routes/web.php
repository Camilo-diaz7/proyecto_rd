<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\DetalleVentaControlador;
use App\Http\Controllers\ProductoControlador;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ventaControlador;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/catalogo', function () {
    return view('catalogo');
})->name('catalogo');

Route::get('/eventos', [EventoController::class, 'mostrarEventos'])->name('eventos.publico');
/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

<<<<<<< Updated upstream
    Route::get('dashboard', function () {
        return redirect()->route('empleados.index');
=======
    Route::get('/dashboard', function () {
        return redirect()->route('admin.empleados.index');
>>>>>>> Stashed changes
    })->name('dashboard');

    // CRUD de empleados (ahora sí bien conectado)
    Route::resource('empleados', EmpleadoController::class);

    // Otras entidades para admin
    Route::resource('ventas', ventaControlador::class);
    Route::resource('productos', ProductoControlador::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('reservaciones', ReservacionController::class);
});

/*
|--------------------------------------------------------------------------
| Cliente
|--------------------------------------------------------------------------
*/
Route::prefix('cliente')->name('cliente.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('cliente.dashboard');
    })->name('dashboard');

    Route::resource('boletas', BoletaController::class);
    Route::resource('reservaciones', ReservacionController::class)
     ->parameters(['reservaciones' => 'reservacion']);
});

/*
|--------------------------------------------------------------------------
| Empleado
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Empleado
|--------------------------------------------------------------------------
*/
Route::prefix('empleado')->name('empleado.')->middleware('auth')->group(function () {
<<<<<<< Updated upstream
=======
    Route::resource('empleado.empl', EmpleadoController::class);
>>>>>>> Stashed changes

    // Dashboard exclusivo del empleado
    Route::get('/empl', function () {
        // Si necesitas pasar empleados/clientes:
        $empleados = \App\Models\User::where('role', 'empleado')->get();
        $clientes  = \App\Models\User::where('role', 'cliente')->get();

        return view('empleado.empl', compact('empleados','clientes'));
    })->name('empl');

    // Solo lectura de ventas y reservaciones
    Route::resource('ventas', ventaControlador::class);
    Route::resource('reservaciones', ReservacionController::class)->only(['index']);
});
