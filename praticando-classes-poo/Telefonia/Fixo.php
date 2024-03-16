<?php
namespace pooWithPhp\Telefonia;
require_once 'TelefoneAbstract.php';

class Fixo extends TelefoneAbstract
{
    protected $custoPorMinuto;

    public function __construct(string $ddd, string $telefone, float $custoPorMinuto)
    {
        parent::__construct($ddd, $telefone);

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

    #[\Override] public function calculaCusto($tempoLigacaoMinuto): float
    {
        return $tempoLigacaoMinuto * $this->custoPorMinuto;
    }
}