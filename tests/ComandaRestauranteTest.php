<?php

namespace Deg540\ExamenJavierIbarra\Test;

use Deg540\ExamenJavierIbarra\ComandaRestaurante;
use Deg540\ExamenJavierIbarra\Menu;
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
        $menuMock->method('getPrice')->willReturn(4.3);

        $comanda = new ComandaRestaurante($menuMock);

        $output = $comanda->manageComanda("añadir pizza");

        $this->assertEquals("pizza x1 | Total: 4.3", $output);
    }

    /**
     * @test
     */
    public function givenAñadirTwoDifferentDishesReturnsDishesXAmount()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(4.2);

        $comanda = new ComandaRestaurante($menuMock);

        $comanda->manageComanda("añadir pizza");
        $output = $comanda->manageComanda("añadir pasta");

        $this->assertEquals("pizza x1 , pasta x1 | Total: 8.4", $output);
    }

    /**
     * @test
     */
    public function givenAñadirSameDishReturnsSameDishXSumAmount()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(2.1);

        $comanda = new ComandaRestaurante($menuMock);

        $comanda->manageComanda("añadir pizza");
        $output = $comanda->manageComanda("añadir pizza");

        $this->assertEquals("pizza x2 | Total: 4.2", $output);
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

    /**
     * @test
     */
    public function givenAñadirFoundDishReturnsDishWithAmountAndPrice()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(4.3);

        $comanda = new ComandaRestaurante($menuMock);

        $output = $comanda->manageComanda("añadir pasta");

        $this->assertEquals("pasta x1 | Total: 4.3", $output);
    }

    /**
     * @test
     */
    public function givenEliminarNotInComandaDishReturnsError()
    {
        $menuMock = $this->createMock(Menu::class);
        $menuMock->method('getPrice')->willReturn(4.3);

        $comanda = new ComandaRestaurante($menuMock);

        $output = $comanda->manageComanda("eliminar pasta");

        $this->assertEquals("El plato seleccionado no existe", $output);
    }

}
