<?php

namespace App\Context\Aplicacion;

use App\Context\Dominio\JugadorFemenino;
use App\Context\Dominio\JugadorMasculino;
use App\Context\Dominio\Suerte;
use App\Context\Infraestructura\JugadorRepository;

final class CrearJugadorMasculinoUseCase
{
    private $jugadorRepository;
    private Suerte $suerte;

    public function __construct(JugadorRepository $jugadorRepository)
    {
        $this->jugadorRepository = $jugadorRepository;
        $this->suerte = Suerte::create();
    }

    public function __invoke(array $data)
    {
        $jugador = new JugadorMasculino(
            $data['nombre'],
            $data['habilidad'],
            $data['fuerza'],
            $data['velocidad'],
            $this->suerte,
            $data['dni']
        );

        $this->jugadorRepository->saveJugadorMasculino($jugador);

        return ["nombre" => $jugador->getNombre(), "dni" => $jugador->getDni()];
    }
}