<?php

namespace App\Context\Dominio;

CONST CANT_GAMES = 6;

class Set extends InstanciaDeJuego {
    private int $cantGames;
    private Game $gameInstance;

    public function __construct() {
        $this->cantGames = CANT_GAMES;
        $this->gameInstance = FabricaDeInstancias::getGame();
        parent::__construct();
    }

    public function crearSubInstancia(): InstanciaDeJuego {
        $this->cantGames = CANT_GAMES;
        $this->gameInstance->resetear();
        return $this->gameInstance;
    }

    protected function finalizado(): bool {
        $puntos1 = $this->resultado['puntos'][0];
        $puntos2 = $this->resultado['puntos'][1];

        if ($this->cantGames-1 == $puntos1 && $this->cantGames-1 == $puntos2) {
            $this->cantGames++;
        }

        if ($this->cantGames == $puntos1 || $this->cantGames == $puntos2) {
            $this->finalizado = (abs($puntos2-$puntos1) >= 2);
        }

        return $this->finalizado;
    }
}