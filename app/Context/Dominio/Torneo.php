<?php

    namespace App\Context\Dominio;

    use Exception;

    class Torneo {
        private array $jugadores;
        private Jugador $ganador;
        private string $nombre;

        public function __construct(string $nombre) {
            $this->nombre = $nombre;
            $this->jugadores = [];
        }

        public function getNombre(): string {
            return $this->nombre;
        }

        public function agregarJugador(Jugador $jugador): void {;
            $this->jugadores[] = $jugador;
        }

        public function jugar(): void {
            if ($this->faltanJugadores()) {
                throw new Exception(
                    'La cantidad de jugadores debe ser potencia de 2. 
                        Se cargaron '.count($this->jugadores).' jugadores.'
                );
            }

            $this->jugarRondas($this->jugadores);
        }

        private function faltanJugadores(): bool {
            for ($i = count($this->jugadores); $i > 1; $i /= 2) {
                if ($i % 2 != 0) return true;
            }
            return false;
        }

        private function jugarRondas(array $jugadores): void {
            $duplas = array_chunk($jugadores, 2);
            $ganadores = [];

            for ($i = 0; $i < count($duplas); $i++) {
                $ganadores[] = $this->getGanadorPartido($duplas[$i]);
            }

            if (count($ganadores) > 1) {
                $this->jugarRondas($ganadores);
            } else {
                $this->ganador = $ganadores[0];
            }
        }

        private function getGanadorPartido(array $jugadores): Jugador {
            $jugador1 = $jugadores[0];
            $jugador2 = $jugadores[1];
            $partido = new Partido();
            $jugador1->jugarContra($jugador2, $partido);
            return $partido->getGanador();
        }

        public function getGanador(): Jugador {
            return $this->ganador;
        }

        public function getJugadores(): array
        {
            return $this->jugadores;
        }
    }