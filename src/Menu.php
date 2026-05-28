<?php
namespace Deg540\ExamenJavierIbarra;

interface Menu
{
    public function getPrice(string $dish): ?float;
}