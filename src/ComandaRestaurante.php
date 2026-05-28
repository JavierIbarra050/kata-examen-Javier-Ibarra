<?php

namespace Deg540\ExamenJavierIbarra;

class ComandaRestaurante
{
    private array $comanda = [];

    public function gestionarComanda(string $action): string
    {
        if (!$action) return "";

        $action = strtolower($action);
        $action = explode(" ", $action);

        $instruction = $action[0];
        $dish = $action[1];
        $amount = $action[2];

        $this->comanda[] = $dish . " x" . $amount;
        return $this->comanda[0];
    }
}