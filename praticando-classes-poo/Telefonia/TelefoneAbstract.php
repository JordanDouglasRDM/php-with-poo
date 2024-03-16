<?php

namespace pooWithPhp\Telefonia;

abstract class TelefoneAbstract
{
    protected $ddd, $telefone;
    public function __construct(string $ddd, string $telefone)
    {
        $this->ddd = $ddd;
        $this->telefone = $telefone;
    }

    abstract protected function calculaCusto(float $tempoLigacaoMinuto): float;
}