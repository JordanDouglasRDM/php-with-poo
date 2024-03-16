<?php

namespace pooWithPhp\Empresa;

class Motorista extends FuncionarioAbstract
{
    private string $ctps;

    public function __construct($codigo, $nome, $salarioBase, $ctps)
    {
        parent::__construct($codigo, $nome, $salarioBase);
        $this->setCtps($ctps);
    }

    private function setCtps(string $ctps): void
    {
        $this->ctps = $ctps;
    }

    public function getCtps(): string
    {
        return $this->ctps;
    }
}