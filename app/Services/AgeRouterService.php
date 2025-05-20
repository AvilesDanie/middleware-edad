<?php

namespace App\Services;

class AgeRouterService
{
    /**
     * Retorna la ruta correspondiente según la edad de la persona.
     */
    public function obtenerRutaPorEdad(int $edad): string
    {
        // Clasifica y devuelve la ruta correspondiente al rango etario.
        // Se usa match() para mantener la lógica ordenada y clara.
        return match (true) {
            $edad <= 5   => '/bebes',
            $edad <= 12  => '/ninos',
            $edad <= 17  => '/adolescentes',
            $edad <= 25  => '/jovenes',
            $edad <= 59  => '/adultos',
            $edad <= 74  => '/mayores',
            $edad <= 120 => '/longevos',
            default      => '/error' 
        };
    }
}
