<?php
namespace App\Context\Dominio;

CONST  MAXSET= 3;

class Partido extends InstanciaDeJuego {
    private int $maxSet;
    private Set $setInstance;

    public function __construct() {
        parent::__construct();
        $this->maxSet = MAXSET;
        $this->setInstance = FabricaDeInstancias::getSet();
    }

    public function crearSubInstancia(): InstanciaDeJuego {
        $this->maxSet = MAXSET;
        $this->setInstance->resetear();
        return $this->setInstance;
    }

    protected function finalizado(): bool {
        $puntos1 = $this->resultado['puntos'][0];
        $puntos2 = $this->resultado['puntos'][1];
        $cantSetsParaGanar = (intdiv($this->maxSet, 2) + 1);

        if ($puntos1 == $cantSetsParaGanar || $puntos2 == $cantSetsParaGanar) {
            $this->finalizado = true;
        }
        return $this->finalizado;
    }
}