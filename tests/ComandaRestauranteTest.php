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
    public function givenAñadirDishWithoutAmountReturnsDishX1()
    {
        $comanda = new ComandaRestaurante();

        $output = $comanda->manageComanda("añadir pizza");

        $this->assertEquals("pizza x1", $output);
    }

    /**
     * @test
     */
    public function givenAñadirTwoDifferentDishesReturnsDishesXAmount()
    {
        $comanda = new ComandaRestaurante();

        $comanda->manageComanda("añadir pizza");
        $output = $comanda->manageComanda("añadir pasta");

        $this->assertEquals("pizza x1 | pasta x1", $output);
    }

    /**
     * @test
     */
    public function givenAñadirSameDishReturnsSameDishXSumAmount()
    {
        $comanda = new ComandaRestaurante();

        $comanda->manageComanda("añadir pizza");
        $output = $comanda->manageComanda("añadir pizza");

        $this->assertEquals("pizza x2", $output);
    }
}
