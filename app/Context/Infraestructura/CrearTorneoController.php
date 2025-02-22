<?php
declare(strict_types = 1);

namespace App\Context\Infraestructura;

use App\Context\Aplicacion\CrearTorneoUseCase;
use Illuminate\Http\Request;

final class CrearTorneoController {
    private $torneoRepository;
    private $jugadoRrepository;

    public function __construct(TorneoRepository $torneoRepository, JugadorRepository $jugadorRepository) {
        $this->torneoRepository = $torneoRepository;
        $this->jugadorRepository = $jugadorRepository;
    }

    public function __invoke(Request $request) {
        $crearTorneoUseCase = new CrearTorneoUseCase($this->torneoRepository, $this->jugadorRepository);

        $data['nombreTorneo'] = $request->input('nombre');
        $data['genero'] = $request->input('genero');
        $data['jugadores_ids'] = explode(',', $request->input('jugadores_ids'));

        return $crearTorneoUseCase->__invoke($data);
    }
}