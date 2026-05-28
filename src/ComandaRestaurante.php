<?php

namespace Deg540\ExamenJavierIbarra;


class ComandaRestaurante
{
    private array $comanda = [];
    private float $totalPrice = 0;

    public function __construct(private Menu $menu)
    {}

    private function comandaToString(): string
    {
        $auxiliarComanda = [];
        foreach ($this->comanda as $dish => $amount)
        {
            $auxiliarComanda[] = $dish . " x" . $amount;
        }

        $dishes = implode(" , ", $auxiliarComanda);
        return $dishes . " | " . "Total: " . $this->totalPrice;
    }

    private function addDish(string $dish, int $amount): string
    {
        $price = $this->menu->getPrice($dish);

        if($price === null) return "El plato seleccionado no existe en el menu";

        $this->totalPrice += $price * $amount;

        if(!isset($this->comanda[$dish]))
        {
            $this->comanda[$dish] = $amount;
        }
        else
        {
            $this->comanda[$dish] += $amount;
        }

        return  $this->comandaToString();
    }

    public function manageComanda(string $action): string
    {
        if (!$action) return "";

        $action = strtolower($action);
        $action = explode(" ", $action);

        $instruction = $action[0];
        $dish = $action[1];

        $amount = 1;

        if (count($action) == 3)
        {
            $amount = (int) $action[2];
        }

        return $this->addDish($dish, $amount);
    }
}