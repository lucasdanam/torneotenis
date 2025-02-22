<?php

namespace App\Context\Aplicacion;

use App\Context\Dominio\JugadorFemenino;
use App\Context\Dominio\Suerte;
use App\Context\Infraestructura\JugadorRepository;

final class CrearJugadorFemeninoUseCase
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
        $jugador = new JugadorFemenino(
            $data['nombre'],
            $data['habilidad'],
            $data['reaccion'],
            $this->suerte,
            $data['dni']
        );

        $this->jugadorRepository->saveJugadorFemenino($jugador);

        return ["nombre" => $jugador->getNombre(), "dni" => $jugador->getDni()];
    }
}