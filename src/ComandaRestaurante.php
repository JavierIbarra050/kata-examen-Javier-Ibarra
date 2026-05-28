<?php

namespace Deg540\ExamenJavierIbarra;

class ComandaRestaurante
{
    private array $comanda = [];

    private function comandaToString(): string
    {
        $auxiliarComanda = [];
        foreach ($this->comanda as $dish => $amount)
        {
            $auxiliarComanda[] = $dish . " x" . $amount;
        }

        return implode(" | ", $auxiliarComanda);
    }

    private function addDish(string $dish, int $amount): string
    {
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