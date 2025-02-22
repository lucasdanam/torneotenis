<?php

namespace App\Context\Dominio;

abstract class Jugador {
    protected string $nombre;
    protected int $habilidad;
    protected Suerte $suerte;
    protected int $dni;

    public function __construct(string $nombre, int $habilidad, Suerte $suerte, int $dni) {
        $this->nombre = $nombre;
        $this->habilidad = $habilidad;
        $this->suerte = $suerte;
        $this->dni = $dni;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getDni(): int
    {
        return $this->dni;
    }

    public function jugarContra(Jugador $adversario, InstanciaDeJuego $instanciaDeJuego): void {
        $instanciaDeJuego->jugar($this, $adversario);
        $instanciaDeJuego->decidirGanador();
    }

    public function getPuntaje(): int {
        return $this->suerte->aplicar($this->habilidad + $this->getPuntajeAdicional());
    }

    abstract public function getPuntajeAdicional(): int;

    public function getHabilidad(): int{
        return $this->habilidad;
    }
}