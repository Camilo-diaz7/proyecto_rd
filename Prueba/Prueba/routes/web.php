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
Route::get ('/ventas/{venta}/detalles', [DetalleVentaControlador::class, 'porVenta'])->name('detalles.porVenta');

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

    Route::get('/dashboard', function () {
        return redirect()->route('admin.empleados.index'); 
    })->name('dashboard');

    // CRUD de empleados (ahora sí bien conectado)
    Route::get ('/ventas/{venta}/detalles', [DetalleVentaControlador::class, 'porVenta'])->name('detalles.porVenta');
    Route::resource('detalles', DetalleVentaControlador::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('ventas', ventaControlador::class);
    Route::resource('productos', ProductoControlador::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('reservaciones', ReservacionController::class)->parameters(['reservaciones' => 'reservacion']);

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
    Route::resource('reservaciones', ReservacionController::class)->parameters(['reservaciones' => 'reservacion']);
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

    Route::resource('ventas', ventaControlador::class);
    Route::resource('reservaciones', ReservacionController::class)->parameters(['reservaciones' => 'reservacion']);
});
