<?php

namespace App\Context\Dominio;

CONST PORCENTAJE_SUERTE = 10;

final class Suerte {

    private int $porcentajeSuerte;
    private static $instance;

    //incrementa o decrementa aleatoriamente el valor total de puntaje de un jugador hasta un $porcentajeSuerte por ciento
    public function __construct($porcentajeSuerte = PORCENTAJE_SUERTE) {
        $this->porcentajeSuerte = $porcentajeSuerte;
    }

    public function aplicar(int $puntaje): int {
        return (int) ($puntaje + $puntaje*(mt_rand(-$this->porcentajeSuerte,$this->porcentajeSuerte))/100);
    }

    public function seleccionar(array $vec) {
        shuffle($vec);
        return $vec[0];
    }

    public static function create(): Suerte {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}