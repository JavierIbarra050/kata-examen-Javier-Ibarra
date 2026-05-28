<?php

namespace Deg540\ExamenJavierIbarra;


class ComandaRestaurante
{
    private array $comanda = [];
    private float $totalPrice = 0;

    public function __construct(private Menu $menu) {}

    private function comandaToString(): string
    {
        $auxiliarComanda = [];
        foreach ($this->comanda as $dish => $amount)
        {
            $amount = explode(",", $this->comanda[$dish])[0];
            $auxiliarComanda[] = $dish . " x" . $amount;
        }

        $dishes = implode(", ", $auxiliarComanda);

        if($auxiliarComanda == []) return "La comanda ha sido vaciada";

        return $dishes . " | " . "Total: " . $this->totalPrice;
    }

    private function emptyComanda(): string
    {
        $this->comanda = [];
        $this->totalPrice = 0;

        return $this->comandaToString();
    }

    private function addDish(string $dish, int $amount): string
    {
        $price = $this->menu->getPrice($dish);

        if($price === null) return "El plato seleccionado no existe en el menu";

        $this->totalPrice += $price * $amount;

        if(!isset($this->comanda[$dish]))
        {
            $this->comanda[$dish] = $amount . "," . $price;
        }
        else
        {
            $dishParts = explode(",", $this->comanda[$dish]);
            $newAmount = $amount + (int) $dishParts[0];

            $this->comanda[$dish] = $newAmount . "," . $dishParts[1];
        }

        return  $this->comandaToString();
    }

    private function deleteDish(string $dish): string
    {
        if(!isset($this->comanda[$dish]))
        {
            return "El plato seleccionado no existe";
        }

        $dishPrice = explode("," , $this->comanda[$dish])[1];

        unset($this->comanda[$dish]);
        $this->totalPrice -= (float) $dishPrice;
        return  $this->comandaToString();
    }

    private function getCuenta(): string
    {
        if ($this->totalPrice == 0) return "Total: 0.00";
        return "Total: " . $this->totalPrice;
    }

    public function manageComanda(string $action): string
    {
        if (!$action) return "";

        $action = strtolower($action);

        if ($action == 'vaciar') {
            return $this->emptyComanda();
        }

        $action = explode(" ", $action);

        $instruction = $action[0];
        $dish = $action[1];

        $amount = 1;
        if (count($action) == 3)
        {
            $amount = (int) $action[2];
        }


        if ($instruction === "añadir")
        {
            return $this->addDish($dish, $amount);
        }
        elseif ($instruction === "eliminar")
        {
            return $this->deleteDish($dish);
        }
        elseif ($instruction === "cuenta")
        {
            return $this->getCuenta();
        }

        return "Instruccion no existente";
    }
}