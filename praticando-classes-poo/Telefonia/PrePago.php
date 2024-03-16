<?php

namespace pooWithPhp\Telefonia;
require_once 'Celular.php';

class PrePago extends Celular
{
    private $acrescimoPre, $custoPorMinutoFinal;
    public function __construct(string $ddd, string $telefone, string $nomeOperadora, float $custoPorMinuto)
    {
        parent::__construct($ddd, $telefone, $nomeOperadora, $custoPorMinuto);

        $this->setAcrescimoPre();
        $this->setCustoPorMinutoFinal();
    }

    public function getAcrescimoPre()
    {
        return $this->acrescimoPre;
    }

    private function setAcrescimoPre(): void
    {
        $this->acrescimoPre = 0.4;
    }

    public function getCustoPorMinutoFinal()
    {
        return $this->custoPorMinutoFinal;
    }

    private function setCustoPorMinutoFinal(): void
    {
        //aplica 40% no custo por minuto base
        $custoPorMinutoFinal = ($this->getAcrescimoPre() * $this->getCustoPorMinuto()) + $this->getCustoPorMinuto();
        $this->custoPorMinutoFinal = $custoPorMinutoFinal;
    }

    #[\Override] public function calculaCusto(float $tempoLigacaoMinuto): float
    {
        return $this->getCustoPorMinutoFinal() * $tempoLigacaoMinuto;
    }
}