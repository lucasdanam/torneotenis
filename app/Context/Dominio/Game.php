<?php

namespace App\Context\Dominio;
use function Symfony\Component\String\u;

CONST VALORES_PUNTO = ['10','30','40','AD'];

class Game extends InstanciaDeJuego
{
    private array $valoresPunto;

    private Punto $subInstancia;

    public function __construct() {
        $this->valoresPunto = VALORES_PUNTO;
        $this->subInstancia = FabricaDeInstancias::getPunto();
        parent::__construct();
    }

    public function crearSubInstancia(): InstanciaDeJuego {
        $this->subInstancia->resetear();
        return $this->subInstancia;
    }

    protected function finalizado(): bool {
        $puntos1 = $this->resultado['puntos'][0];
        $puntos2 = $this->resultado['puntos'][1];
        if (count($this->valoresPunto) == $puntos1 && count($this->valoresPunto) == $puntos2) {
            $puntos1--;
            $puntos2--;
        }

        if (count($this->valoresPunto) <= $puntos1 || count($this->valoresPunto) <= $puntos2) {
            $this->finalizado = (abs($puntos2-$puntos1) >= 1);
        }

        return $this->finalizado;
    }
}