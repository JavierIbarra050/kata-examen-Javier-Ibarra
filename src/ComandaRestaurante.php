<?php

namespace Deg540\ExamenJavierIbarra;

class ComandaRestaurante
{
    public function gestionarComanda(string $action): string
    {
        if (!$action) return "";

        $action = strtolower($action);
        $action = explode(" ", $action);

        $instruction = $action[0];
        $dish = $action[1];

        return $dish;
    }
}