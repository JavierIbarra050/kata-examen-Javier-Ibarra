<?php

namespace Deg540\ExamenJavierIbarra\Test;

use Deg540\ExamenJavierIbarra\ComandaRestaurante;
use PHPUnit\Framework\TestCase;

class ComandaRestauranteTest extends TestCase
{
    /**
     * @test
     */
    public function givenEmptyActionReturnsEmptyString()
    {
        $comanda = new ComandaRestaurante();

        $output = $comanda->gestionarComanda("");

        $this->assertEquals("", $output);
    }
}
