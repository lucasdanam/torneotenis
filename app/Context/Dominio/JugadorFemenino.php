<?php

namespace App\Context\Dominio;

class JugadorFemenino extends Jugador {
    private int $tiempoReaccion;

    public function __construct(string $nombre, int $habilidad, $tiempoReaccion, $suerte, $dni) {
        parent::__construct($nombre, $habilidad, $suerte, $dni);
        $this->tiempoReaccion = $tiempoReaccion;
    }

    public function getPuntajeAdicional(): int {
        return $this->tiempoReaccion;
    }

    public function getTiempoReaccion(): int {
        return $this->tiempoReaccion;
    }
}