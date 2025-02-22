<?php

namespace App\Context\Infraestructura;

use App\Models\JugadorFemenino;
use App\Models\JugadorMasculino;
use Illuminate\Database\Eloquent\Collection;

final class JugadorRepository {
    private $jugadorModelMasculino;
    private $jugadorModelFemenino;

    public function __construct() {
        $this->jugadorModelMasculino = new JugadorMasculino;
        $this->jugadorModelFemenino = new JugadorFemenino;
    }

    public function saveJugadorMasculino(\App\Context\Dominio\JugadorMasculino $jugador): void {
        $data = [
            'nombre' => $jugador->getNombre(),
            'habilidad' => $jugador->getHabilidad(),
            'fuerza' => $jugador->getFuerza(),
            'velocidad' => $jugador->getVelocidad(),
            'dni' => $jugador->getDni(),
        ];

        $this->jugadorModelMasculino->create($data);
    }

    public function saveJugadorFemenino(\App\Context\Dominio\JugadorFemenino $jugador): void {
        $data = [
            'nombre' => $jugador->getNombre(),
            'dni' => $jugador->getDni(),
            'habilidad' => $jugador->getHabilidad(),
            'reaccion' => $jugador->getTiempoReaccion()
        ];

        $this->jugadorModelFemenino->create($data);
    }

    public function getJugadorMasculino(int $id) {
        return $this->jugadorModelMasculino::find($id);
    }

    public function getJugadorFemenino(int $jugador_id) {
        return $this->jugadorModelFemenino->find($jugador_id);
    }
}