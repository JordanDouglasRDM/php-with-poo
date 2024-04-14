<?php

namespace Php\Projeto2\Model\Domain;

class Produto
{
    protected string $nome;
    protected float $valor;
    protected int $categoriaId;

    public function __construct(string $nome, float $valor, int $categoriaId)
    {
        $this->setNome($nome);
        $this->setValor($valor);
        $this->setCategoriaId($categoriaId);
    }

    private function setCategoriaId(int $categoriaId): void
    {
        $this->categoriaId = $categoriaId;
    }

    private function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    private function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValor(): float
    {
        return $this->valor;
    }
}