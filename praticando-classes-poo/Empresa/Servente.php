<?php

namespace pooWithPhp\Empresa;

use pooWithPhp\Empresa\FuncionarioAbstract;

class Servente extends FuncionarioAbstract
{
    private float $adicional;

    public function __construct($codigo, $nome, $salarioBase)
    {
        parent::__construct($codigo, $nome, $salarioBase);
        $this->setAdicional();
    }

    public function toString(): string
    {
        $relatorio = parent::toString();
        $relatorio .= 'Adicional: ' . $this->getAdicional();
        return $relatorio;
    }

    public function getSalarioLiquido(): float
    {
        return parent::getSalarioLiquido() + $this->getAdicional();
    }

    protected function getAdicional(): float
    {
        return $this->adicional;
    }

    protected function setAdicional(): void
    {
        //5% de insalubridade
        $adicional = parent::getSalarioBase() * 0.05;
        $this->adicional = $adicional;
    }
}