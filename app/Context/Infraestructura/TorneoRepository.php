<?php

namespace App\Context\Infraestructura;

use App\Models\Torneo;

final class TorneoRepository {
    private $torneoModel;

    public function __construct() {
        $this->torneoModel = new Torneo;
    }

    public function save(\App\Context\Dominio\Torneo $torneo) {
        $data = ['nombre' => $torneo->getNombre()];
        return $this->torneoModel->create($data);
    }

    public function attachJugadorMasculino($torneoid,$jugadorid): void {
        $this->torneoModel->jugadoresMasculinos()->attach($jugadorid, ['torneo_id' => $torneoid]);
    }

    public function attachJugadorFemenino($torneoid,$jugadorid): void {
        $this->torneoModel->jugadoresFemeninos()->attach($jugadorid, ['torneo_id' => $torneoid]);
    }
}