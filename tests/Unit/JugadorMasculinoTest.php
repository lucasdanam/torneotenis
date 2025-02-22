<?php

namespace Tests\Unit;

use App\Context\Dominio\Game;
use App\Context\Dominio\JugadorMasculino;
use App\Context\Dominio\Partido;
use App\Context\Dominio\Punto;
use App\Context\Dominio\Suerte;
use Tests\TestCase;

class JugadorMasculinoTest extends TestCase {
    private $jugador;
    private Suerte $suerte;
    private int $porcentajeSuerte;
    protected function setUp(): void {
        $this->porcentajeSuerte = 10;
        $this->suerte = new Suerte($this->porcentajeSuerte);
    }

    public function testGetNombre(): void
    {
        $habilidad = 80;
        $fuerza = 10;
        $velocidad = 20;
        $jugador = new JugadorMasculino('lucas',$habilidad,$fuerza,$velocidad, $this->suerte, 40331222);
        $this->assertEquals('lucas', $jugador->getNombre());
    }

    public function testGetPuntajeAdicional(): void
    {
        $habilidad = 80;
        $fuerza = 10;
        $velocidad = 20;
        $jugador = new JugadorMasculino('lucas',$habilidad,$fuerza,$velocidad, $this->suerte, 18012999);
        $this->assertEquals($jugador->getPuntajeAdicional(), $fuerza+$velocidad);
    }

    public function testGetPuntajeSinSuerte(): void
    {
        $habilidad = 80;
        $fuerza = 10;
        $velocidad = 20;
        $jugador = new JugadorMasculino('lucas',$habilidad,$fuerza,$velocidad, new Suerte(0), 13791444);
        $this->assertEquals($jugador->getPuntaje(), $habilidad+$fuerza+$velocidad);
    }

    public function testJugarPuntoContraJugadorConBajaPuntuacion() {
        //la suerte disminuye o aumenta hasta porcentajeSuerte asi que el jugador2 no puede ganar
        $habilidad1 = 80;
        $fuerza1 = 10;
        $velocidad1 = 20;
        $jugador1 = new JugadorMasculino('lucas',$habilidad1,$fuerza1,$velocidad1, $this->suerte, 90000000);

        $habilidad2 = (int) ($habilidad1 - $habilidad1*($this->porcentajeSuerte+15)/100);
        $fuerza2 = (int) ($fuerza1 - $fuerza1*($this->porcentajeSuerte+15)/100);
        $velocidad2 = (int) ($velocidad1 - $velocidad1*($this->porcentajeSuerte+15)/100);
        $jugador2 = new JugadorMasculino('pedro',$habilidad2,$fuerza2,$velocidad2, $this->suerte, 91350597);

        $punto = new Punto();
        $jugador1->jugarContra($jugador2, $punto);
        $this->assertEquals($punto->getGanador(), $jugador1);
    }

    public function testJugarGameContraJugadorConBajaPuntuacion() {
        //la suerte disminuye o aumenta hasta porcentajeSuerte asi que el jugador2 no puede ganar
        $habilidad1 = 80;
        $fuerza1 = 10;
        $velocidad1 = 20;
        $jugador1 = new JugadorMasculino('lucas',$habilidad1,$fuerza1,$velocidad1, $this->suerte, 34123456);

        $habilidad2 = (int) ($habilidad1 - $habilidad1*($this->porcentajeSuerte+2)/100);
        $fuerza2 = (int) ($fuerza1 - $fuerza1*($this->porcentajeSuerte+2)/100);
        $velocidad2 = (int) ($velocidad1 - $velocidad1*($this->porcentajeSuerte+2)/100);
        $jugador2 = new JugadorMasculino('pedro',$habilidad2,$fuerza2,$velocidad2, $this->suerte, 34174599);

        $game = new Game();
        $jugador1->jugarContra($jugador2, $game);
        $this->assertEquals($game->getGanador(), $jugador1);
    }

    public function testJugarPartidoContraJugadorConAltaPuntuacion() {
        //la suerte disminuye o aumenta hasta 10% asi que el jugador2 debe ganar todos los sets
        $habilidad1 = 80;
        $fuerza1 = 10;
        $velocidad1 = 20;
        $jugador1 = new JugadorMasculino('lucas',$habilidad1,$fuerza1,$velocidad1, $this->suerte, 23174899);

        $habilidad2 = (int) ($habilidad1 + $habilidad1*($this->porcentajeSuerte+2)/100);
        $fuerza2 = (int) ($fuerza1 + $fuerza1*($this->porcentajeSuerte+2)/100);
        $velocidad2 = (int) ($velocidad1 + $velocidad1*($this->porcentajeSuerte+2)/100);
        $jugador2 = new JugadorMasculino('pedro',$habilidad2,$fuerza2,$velocidad2, $this->suerte, 12456789);

        $partido = new Partido();
        $jugador1->jugarContra($jugador2, $partido);
        $this->assertEquals($partido->getGanador(), $jugador2);
        $this->assertEquals([0,2], array_column($partido->getResultado(), 'puntos'));
    }
}