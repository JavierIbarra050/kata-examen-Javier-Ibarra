<?php

namespace Deg540\ExamenJavierIbarra\Test;

use Deg540\ExamenJavierIbarra\ComandaRestaurante;
use Menu;
use PHPUnit\Framework\TestCase;

class ComandaRestauranteTest extends TestCase
{
    /**
     * @test
     */
    public function givenEmptyActionReturnsEmptyString()
    {
        $menuDummy = $this->createMock(Menu::class);
        $comanda = new ComandaRestaurante($menuDummy);

        $output = $comanda->manageComanda("");

        $this->assertEquals("", $output);
    }

    /**
     * @test
     */
    public function givenAñadirDishWithoutAmountReturnsDishX1()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(4);

        $comanda = new ComandaRestaurante($menuMock);

        $output = $comanda->manageComanda("añadir pizza");

        $this->assertEquals("pizza x1", $output);
    }

    /**
     * @test
     */
    public function givenAñadirTwoDifferentDishesReturnsDishesXAmount()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(4);

        $comanda = new ComandaRestaurante($menuMock);

        $comanda->manageComanda("añadir pizza");
        $output = $comanda->manageComanda("añadir pasta");

        $this->assertEquals("pizza x1 | pasta x1", $output);
    }

    /**
     * @test
     */
    public function givenAñadirSameDishReturnsSameDishXSumAmount()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(4);

        $comanda = new ComandaRestaurante($menuMock);

        $comanda->manageComanda("añadir pizza");
        $output = $comanda->manageComanda("añadir pizza");

        $this->assertEquals("pizza x2", $output);
    }

    /**
     * @test
     */
    public function givenAñadirNotFoundDishReturnsError()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(null);

        $comanda = new ComandaRestaurante($menuMock);

        $output = $comanda->manageComanda("añadir chorizo");

        $this->assertEquals("El plato seleccionado no existe en el menu", $output);
    }

}
