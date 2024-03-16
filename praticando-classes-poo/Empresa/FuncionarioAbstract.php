<?php

namespace pooWithPhp\Empresa;

abstract class FuncionarioAbstract
{
    protected $codigo, $nome, $salarioBase;

    public function __construct($codigo, $nome, $salarioBase)
    {
        $this->setCodigo($codigo);
        $this->setNome($nome);
        $this->setSalarioBase($salarioBase);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getSalarioBase()
    {
        return $this->salarioBase;
    }

    private function setNome($nome): void
    {
        $this->nome = $nome;
    }

    private function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    protected function setSalarioBase($salarioBase): void
    {
        $this->salarioBase = $salarioBase;
    }

    public function getSalarioLiquido(): float
    {
        $salarioBase = $this->getSalarioBase();
        $inss = $salarioBase * 0.1;
        $ir = 0.0;

        if ($salarioBase > 2000.00) {
            $ir = ($salarioBase - 2000.00) * 0.12;
        }
        $salarioLiquido = $salarioBase - $inss - $ir;

        return $salarioLiquido;
    }

    public function toString()
    {
        return (
            PHP_EOL .
            "Codigo: {$this->getCodigo()}" . PHP_EOL .
            "Nome: {$this->getNome()}" . PHP_EOL .
            "Salário Base: {$this->getSalarioBase()}" . PHP_EOL .
            "Salário Líquido: {$this->getSalarioLiquido()}" . PHP_EOL
        );
    }
}