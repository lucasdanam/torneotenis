<?php

namespace App\Context\Dominio;

abstract class InstanciaDeJuego {

    protected Jugador $jugador1;
    protected Jugador $jugador2;
    protected Jugador $ganador;
    protected array $instanciasJuego;
    protected bool $finalizado;
    protected array $resultado;
    protected Suerte $suerte;

    protected function __construct() {
        $this->instanciasJuego = [];
        $this->finalizado = false;
        $this->resultado = ['jugadores' => [], 'puntos' => []];
        $this->suerte = Suerte::create();
    }

    public function jugar(Jugador $jugador1, Jugador $jugador2): void {
        $this->jugador1 = $jugador1;
        $this->jugador2 = $jugador2;
        $this->resultado['jugadores'] = [$this->jugador1, $this->jugador2];
        $this->resultado['puntos'] = [0, 0];
        for ($i = 0; !$this->finalizado(); $i++) {
            $subInstancia = $this->crearSubInstancia();;
            $this->instanciasJuego[] = $subInstancia;
            $this->jugador1->jugarContra($this->jugador2, $subInstancia);
            $position = array_search($subInstancia->getGanador(), $this->resultado['jugadores']);
            $this->resultado['puntos'][$position]++;
            unset($subInstancia);
        }
    }

    public function getGanador(): Jugador {
        return $this->ganador;
    }

    public function decidirGanador(): void {
        $keyGanador = array_keys(
            $this->resultado['puntos'],
            max($this->resultado['puntos'])
        )[0];

        $this->ganador = $this->resultado['jugadores'][$keyGanador];
    }

    public function getResultado(): array {
        return [
            ['jugador' => $this->resultado['jugadores'][0], 'puntos' => $this->resultado['puntos'][0]],
            ['jugador' => $this->resultado['jugadores'][1], 'puntos' => $this->resultado['puntos'][1]],
        ];
    }

    abstract protected function crearSubInstancia(): InstanciaDeJuego;
    abstract protected function finalizado(): bool;

    public function resetear(): void
    {
        $this->instanciasJuego = [];
        $this->finalizado = false;
        $this->resultado = [];
    }
}