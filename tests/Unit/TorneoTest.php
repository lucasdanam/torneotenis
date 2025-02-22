<?php

namespace Tests\Unit;

use App\Context\Dominio\JugadorFemenino;
use App\Context\Dominio\Suerte;
use App\Context\Dominio\Torneo;
use Tests\TestCase;

class TorneoTest extends TestCase
{
    private Suerte $suerte;
    private int $porcentajeSuerte;

    protected function setUp(): void
    {
        $this->porcentajeSuerte = 10;
        $this->suerte = new Suerte($this->porcentajeSuerte);
    }



    public function testObtenerGanadorSinSuerteEnTorneoDe4(): void
    {
        $torneo = new Torneo('test');
        $habilidad = 80;
        $reaccion = 20;

        $jugador1 = new JugadorFemenino('luciana', $habilidad, $reaccion, new Suerte(0), 13791544);
        $jugador2 = new JugadorFemenino('laura', $habilidad+1, $reaccion+1, new Suerte(0), 13791548);
        $jugador3 = new JugadorFemenino('paola', $habilidad+2, $reaccion+9, new Suerte(0), 13791550);
        $jugador4 = new JugadorFemenino('carla', $habilidad+14, $reaccion+14, new Suerte(0), 13791560);

        $torneo->agregarJugador($jugador1);
        $torneo->agregarJugador($jugador2);
        $torneo->agregarJugador($jugador3);
        $torneo->agregarJugador($jugador4);

        $torneo->jugar();

        //jugador 4 carla tiene mas puntos, como no hay suerte debe ganar
        $this->assertEquals($jugador4, $torneo->getGanador());
    }

    /**
     * @throws \Exception
     */
    public function testAgregar3JugadoresLanzaExcepcionAlJugar(): void
    {
        $torneo = new Torneo('test');
        $habilidad = 80;
        $reaccion = 20;

        $jugador1 = new JugadorFemenino('luciana', $habilidad, $reaccion, new Suerte(0), 13791544);
        $jugador2 = new JugadorFemenino('laura', $habilidad+1, $reaccion+1, new Suerte(0), 13791550);
        $jugador3 = new JugadorFemenino('paola', $habilidad+2, $reaccion+9, new Suerte(0), 13791560);

        $torneo->agregarJugador($jugador1);
        $torneo->agregarJugador($jugador2);
        $torneo->agregarJugador($jugador3);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('La cantidad de jugadores debe ser potencia de 2. 
                        Se cargaron 3 jugadores.');
        $torneo->jugar();
    }
}