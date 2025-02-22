<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CrearTorneoController extends Controller {

    private $crearTorneoController;

    public function __construct(\App\Context\Infraestructura\CrearTorneoController $createTorneoController) {
        $this->crearTorneoController = $createTorneoController;
    }

    public function __invoke(Request $request) {
       $newTorneo = $this->crearTorneoController->__invoke($request);
       return response($newTorneo, 201);
    }
}