<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CrearJugadorController extends Controller
{

    private $crearJugadorController;

    public function __construct(\App\Context\Infraestructura\CrearJugadorController $createJugadorController)
    {
        $this->crearJugadorController = $createJugadorController;
    }

    public function __invoke(Request $request)
    {
        $newJugador = $this->crearJugadorController->__invoke($request);
        return response($newJugador, 201);
    }
}