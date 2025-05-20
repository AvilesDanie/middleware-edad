<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ClasificarEdadMiddleware;
use App\Http\Middleware\VerificarAccesoEdadMiddleware;

// Ruta principal: muestra el formulario público para ingresar la edad.
// Esta vista es accesible sin autenticación ni clasificación.
Route::get('/', fn() => view('edad'))->name('edad.formulario');

// Procesamiento del formulario de edad (método POST)
// Se aplica el middleware ClasificarEdadMiddleware para validar y clasificar la edad.
// Luego se redirige a la ruta correspondiente.
Route::post('/procesar-edad', function () {
    // Este bloque no se ejecuta si el middleware redirige antes
})->middleware(ClasificarEdadMiddleware::class)->name('procesar.edad');

// Grupo de rutas protegidas por el middleware VerificarAccesoEdadMiddleware
// Solo se puede acceder a estas rutas si previamente se ingresó una edad válida
// y la ruta autorizada se encuentra guardada en la sesión.
Route::middleware(VerificarAccesoEdadMiddleware::class)->group(function () {
    Route::get('/bebes', [App\Http\Controllers\BebesController::class, 'index']);
    Route::get('/ninos', [App\Http\Controllers\NinosController::class, 'index']);
    Route::get('/adolescentes', [App\Http\Controllers\AdolescentesController::class, 'index']);
    Route::get('/jovenes', [App\Http\Controllers\JovenesController::class, 'index']);
    Route::get('/adultos', [App\Http\Controllers\AdultosController::class, 'index']);
    Route::get('/mayores', [App\Http\Controllers\MayoresController::class, 'index']);
    Route::get('/longevos', [App\Http\Controllers\LongevosController::class, 'index']);
});

