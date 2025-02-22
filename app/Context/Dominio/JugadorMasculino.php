<?php

namespace App\Context\Dominio;

class JugadorMasculino extends Jugador {
    private int $fuerza;
    private int $velocidad;

    public function __construct(string $nombre, int $habilidad, int $fuerza, int $velocidad, Suerte $suerte, int $dni) {
        parent::__construct($nombre, $habilidad, $suerte, $dni);
        $this->fuerza = $fuerza;
        $this->velocidad = $velocidad;
    }

    public function getPuntajeAdicional(): int {
        return $this->velocidad + $this->fuerza;
    }

    public function getHabilidad(): int{
        return $this->habilidad;
    }

    public function getVelocidad(): int {
        return $this->velocidad;
    }

    public function getFuerza(): int {
        return $this->fuerza;
    }
}