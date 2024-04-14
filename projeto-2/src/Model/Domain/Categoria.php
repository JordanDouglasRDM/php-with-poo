<?php

namespace Php\Projeto2\Model\Domain;

class Categoria
{
    private string $descricao;

    public function __construct(string $descricao)
    {
        $this->setDescricao($descricao);
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    private function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
}