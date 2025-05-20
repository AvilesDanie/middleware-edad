<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarAccesoEdadMiddleware
{
    /**
     * Middleware para proteger rutas según la edad ingresada previamente.
     * Verifica que el usuario haya pasado por la clasificación de edad y
     * que la ruta que intenta visitar sea la correspondiente a su grupo.
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtener desde la sesión la ruta autorizada para este usuario (ej. "/adultos")
        $rutaAutorizada = session('grupo_edad');

        // Verificar si:
        // 1. No hay ruta guardada en sesión (el usuario no ingresó su edad)
        // 2. O la ruta actual no coincide con la autorizada
        if (!$rutaAutorizada || $request->path() !== ltrim($rutaAutorizada, '/')) {
            // Si no está autorizado, redirigir al formulario inicial con un mensaje de error
            return redirect()->route('edad.formulario')->withErrors('Debes ingresar tu edad primero.');
        }

        // Si pasa la verificación, continuar con la petición
        return $next($request);
    }
}
