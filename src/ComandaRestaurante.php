<?php

namespace Deg540\ExamenJavierIbarra;

class ComandaRestaurante
{
    private array $comanda = [];

    private function addDish(string $dish, int $amount): string
    {
        $this->comanda[] = $dish . " x" . $amount;
        return  $dish . " x" . $amount;
    }

    public function manageComanda(string $action): string
    {
        if (!$action) return "";

        $action = strtolower($action);
        $action = explode(" ", $action);

        $instruction = $action[0];
        $dish = $action[1];
        $amount = count($action) == 3 ? $action[2] : 1;

        return $this->addDish($dish, $amount);
    }
}