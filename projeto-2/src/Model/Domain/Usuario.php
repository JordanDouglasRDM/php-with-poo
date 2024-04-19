<?php

namespace Php\Projeto2\Model\Domain;

class Usuario
{
    protected string $nome;
    protected string $cpf;

    public function __construct(string $nome, string $cpf)
    {
        $this->setNome($nome);
        $this->setCpf($cpf);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

}