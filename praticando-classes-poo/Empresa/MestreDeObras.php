<?php

namespace pooWithPhp\Empresa;

class MestreDeObras extends Servente
{
    private int $qtdFuncionarios;

    public function __construct($codigo, $nome, $salarioBase, $qtdFuncionarios)
    {
        parent::__construct($codigo, $nome, $salarioBase);
        $this->setQtdFuncionarios($qtdFuncionarios);
    }

    public function getAdicional(): float
    {
        $adicional10Percent = parent::getAdicional() * 2;
        // floor arredonda o número para baixo
        $gruposDe10Funcionarios = floor($this->getQtdFuncionarios() / 10);
        $novoAdicional = $gruposDe10Funcionarios * $adicional10Percent;
        return $novoAdicional;
    }

    public function getQtdFuncionarios()
    {
        return $this->qtdFuncionarios;
    }
    public function setQtdFuncionarios($qtdFuncionarios): void
    {
        $this->qtdFuncionarios = $qtdFuncionarios;
    }
}