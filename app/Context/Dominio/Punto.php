<?php

namespace App\Context\Dominio;

class Punto extends InstanciaDeJuego

{
    public function __construct() {
        parent::__construct();
    }

    public function jugar($jugador1, $jugador2): void {
        $this->jugador1 = $jugador1;
        $this->jugador2 = $jugador2;
        $this->decidirGanador();
    }

    public function decidirGanador(): void {
        $this->ganador = $this->jugador1;
        if ($this->jugador1->getPuntaje() < $this->jugador2->getPuntaje()) {
            $this->ganador = $this->jugador2;
        } elseif ($this->jugador1->getPuntaje() == $this->jugador2->getPuntaje()) {
            $this->ganador = $this->suerte->seleccionar([$this->jugador1,$this->jugador2]);
        }
    }

    protected function finalizado(): bool
    {
        $this->finalizado = true;
        return $this->finalizado;
    }

    protected function crearSubInstancia(): InstanciaDeJuego
    {
        return 0;
    }
}