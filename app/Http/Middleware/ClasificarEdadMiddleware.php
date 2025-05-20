<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AgeRouterService;

class ClasificarEdadMiddleware
{
    /**
     * Maneja la clasificación de la edad antes de permitir el acceso.
     * Este middleware se ejecuta en la ruta POST que recibe la edad desde el formulario.
     */
    public function handle(Request $request)
    {
        // Obtener la edad ingresada desde la solicitud
        $edad = $request->input('edad');

        // Validar que la edad sea numérica y esté dentro del rango permitido (0 a 120)
        if (!is_numeric($edad) || $edad < 0 || $edad > 120) {
            // Si no es válida, redirigir a una vista de error
            return redirect()->route('edad.formulario');
        }

        // Obtener la ruta destino correspondiente según la edad usando el servicio AgeRouterService
        $ruta = app(AgeRouterService::class)->obtenerRutaPorEdad((int) $edad);

        // Guardar en la sesión la ruta autorizada para el usuario, para control posterior
        session(['grupo_edad' => $ruta]);

        // Redirigir al usuario a la ruta correspondiente a su grupo etario
        return redirect($ruta);
    }
}
