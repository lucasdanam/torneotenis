<?php

namespace Tests\Unit;

use App\Context\Dominio\Suerte;
use Tests\TestCase;

class SuerteTest extends TestCase {
    private $suerte;
    protected function setUp(): void {
        $this->suerte = new Suerte(10);
    }

    public function testSuerteAumentaYDisminuyeHasta10PorCientoPuntaje(): void
    {
        $puntaje = 100;

        $this->assertThat(
            $this->suerte->aplicar($puntaje),
            $this->logicalAnd(
                $this->greaterThanOrEqual($puntaje - $puntaje*0.1),
                $this->lessThanOrEqual($puntaje + $puntaje*0.1)
            )
        );
    }
}