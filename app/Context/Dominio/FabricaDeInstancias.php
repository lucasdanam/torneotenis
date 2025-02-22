<?php

namespace App\Context\Dominio;

use App\Context\Dominio\Punto;

class FabricaDeInstancias {
    static function getPunto(): Punto
    {
        return new Punto();
    }

    static function getGame(): Game {
        return new Game();
    }

    static function getSet(): Set
    {
        return new Set();
    }
}