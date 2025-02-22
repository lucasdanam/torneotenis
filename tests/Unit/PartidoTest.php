<?php

namespace Tests\Unit;

use App\Context\Dominio\JugadorFemenino;
use App\Context\Dominio\Partido;
use App\Context\Dominio\Suerte;
use Tests\TestCase;

class PartidoTest extends TestCase
{
    private Suerte $suerte;
    private int $porcentajeSuerte;

    protected function setUp(): void
    {
        $this->porcentajeSuerte = 10;
        $this->suerte = new Suerte($this->porcentajeSuerte);
    }

    public function testGetResultadoFinal(): void
    {
        $partido = new Partido();
        $habilidad = 80;
        $reaccion = 20;
        $jugador1 = new JugadorFemenino('luciana', $habilidad, $reaccion, new Suerte(0), 34999999);
        $jugador2 = new JugadorFemenino('laura', $habilidad+1, $reaccion+1, new Suerte(0), 34999991);
        $partido->jugar($jugador1, $jugador2);
        $partido->decidirGanador();
        $resultado = array_column($partido->getResultado(), 'puntos');
        //La diferencia de sets cuando termina el partido siempre va a ser de dos (2-1,2-0)
        $this->assertTrue(in_array([$resultado[0],$resultado[1]], [[0,2],[1,2]]));
        $this->assertEquals($jugador2, $partido->getGanador());
    }


}