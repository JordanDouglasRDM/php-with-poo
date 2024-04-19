<?php

namespace Php\Projeto2\Model\Domain;

class Produto
{
    protected string $nome;
    protected float $valor;
    protected int $categoriasId;

    public function __construct(string $nome, float $valor, int $categoriasId)
    {
        $this->setNome($nome);
        $this->setValor($valor);
        $this->setCategoriasId($categoriasId);
    }

    private function setCategoriasId(int $categoriasId): void
    {
        $this->categoriasId = $categoriasId;
    }

    private function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    private function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getCategoriasId(): int
    {
        return $this->categoriasId;
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