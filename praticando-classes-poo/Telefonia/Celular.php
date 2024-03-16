<?php

namespace pooWithPhp\Telefonia;
require_once 'TelefoneAbstract.php';

abstract class Celular extends TelefoneAbstract
{
    private $nomeOperadora, $custoPorMinuto;

    public function __construct(string $ddd, string $telefone, string $nomeOperadora, float $custoPorMinuto)
    {
        parent::__construct($ddd, $telefone);

        $this->setNomeOperadora($nomeOperadora);
        $this->setCustoPorMinuto($custoPorMinuto);
    }

    public function getCustoPorMinuto()
    {
        return $this->custoPorMinuto;
    }

    public function setCustoPorMinuto(float $custoPorMinuto): void
    {
        if ($custoPorMinuto < 0) {
            $custoPorMinuto = 0;
        }
        $this->custoPorMinuto = $custoPorMinuto;
    }

    public function getNomeOperadora(): string
    {
        return $this->nomeOperadora;
    }

    public function setNomeOperadora(string $nomeOperadora): void
    {
        $this->nomeOperadora = $nomeOperadora;
    }

}