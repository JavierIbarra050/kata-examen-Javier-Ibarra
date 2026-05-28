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

        $output = $comanda->manageComanda("");

        $this->assertEquals("", $output);
    }

    /**
     * @test
     */
    public function givenAñadirDishWithAmountReturnsDishXAmount()
    {
        $comanda = new ComandaRestaurante();

        $output = $comanda->manageComanda("añadir pizza 2");

        $this->assertEquals("pizza x2", $output);
    }
}
