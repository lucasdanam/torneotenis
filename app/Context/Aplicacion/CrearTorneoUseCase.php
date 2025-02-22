<?php

namespace App\Context\Aplicacion;

use App\Context\Dominio\JugadorFemenino;
use App\Context\Dominio\JugadorMasculino;
use App\Context\Dominio\Suerte;
use App\Context\Dominio\Torneo;
use App\Context\Infraestructura\JugadorRepository;
use App\Context\Infraestructura\TorneoRepository;

final class CrearTorneoUseCase
{
    private $jugadorRepository;
    private $torneoRepository;


    public function __construct(TorneoRepository $torneoRepository, JugadorRepository $jugadorRepository)
    {
        $this->torneoRepository = $torneoRepository;
        $this->jugadorRepository = $jugadorRepository;
    }

    public function __invoke(array $data)
    {
        $torneo = new Torneo($data['nombreTorneo']);
        $suerte = Suerte::create();
        $torneoModel = $this->torneoRepository->save($torneo);

        foreach ($data['jugadores_ids'] as $jugador_id) {
            if ($data['genero'] == 'M') {
                $jugadorModel = $this->jugadorRepository->getJugadorMasculino($jugador_id);

                $jugador = new JugadorMasculino(
                    $jugadorModel['nombre'],
                    $jugadorModel['habilidad'],
                    $jugadorModel['fuerza'],
                    $jugadorModel['velocidad'],
                    $suerte,
                    $jugadorModel['dni']
                );

                $torneo->agregarJugador($jugador);
                $this->torneoRepository->attachJugadorMasculino($torneoModel->getKey(), $jugadorModel->getKey());
            } else {
                $jugadorModel = $this->jugadorRepository->getJugadorFemenino($jugador_id);

                $jugador = new JugadorFemenino(
                    $jugadorModel['nombre'],
                    $jugadorModel['habilidad'],
                    $jugadorModel['reaccion'],
                    $suerte,
                    $jugadorModel['dni']
                );

                $torneo->agregarJugador($jugador);

                $this->torneoRepository->attachJugadorFemenino($torneoModel->getKey(), $jugadorModel->getKey());
            }
        }

        try {
            $torneo->jugar();
        } catch (\Exception $e ) {
             throw $e;
        }

        $nombreGanador = $torneo->getGanador()->getNombre();
        unset($torneo);
        unset($torneoModel);
        unset($suerte);
        return ['ganador' => $nombreGanador];
    }
}