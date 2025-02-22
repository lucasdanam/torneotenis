<?php
declare(strict_types = 1);

namespace App\Context\Infraestructura;

use App\Context\Aplicacion\CrearJugadorFemeninoUseCase;
use App\Context\Aplicacion\CrearJugadorMasculinoUseCase;
use Illuminate\Http\Request;

final class CrearJugadorController {
    private $repository;

    public function __construct(JugadorRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(Request $request) {
        $jugadorData = [
            'nombre' => $request->input('nombre'),
            'dni' => $request->input('dni'),
            'habilidad' => $request->input('habilidad')
        ];
        if ($request->input('genero') == 'M') {
            $crearJugadorUseCase = new CrearJugadorMasculinoUseCase($this->repository);
            $jugadorData['fuerza'] = $request->input('fuerza');
            $jugadorData['velocidad'] = $request->input('velocidad');
        } else {
            $crearJugadorUseCase = new CrearJugadorFemeninoUseCase($this->repository);
            $jugadorData['reaccion'] = $request->input('reaccion');
        }

        return $crearJugadorUseCase->__invoke($jugadorData);
    }
}