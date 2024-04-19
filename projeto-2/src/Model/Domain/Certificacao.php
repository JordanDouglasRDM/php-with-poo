<?php

namespace Php\Projeto2\Model\Domain;

class Certificacao
{
    protected string $titulo;
    protected string $descricao;
    protected string $empresa;
    protected int $usuariosId;

    public function __construct(string $titulo, string $descricao, string $empresa, int $usuariosId)
    {
        $this->setTitulo($titulo);
        $this->setDescricao($descricao);
        $this->setEmpresa($empresa);
        $this->setUsuariosId($usuariosId);
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setEmpresa(string $empresa): void
    {
        $this->empresa = $empresa;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setUsuariosId(int $usuariosId): void
    {
        $this->usuariosId = $usuariosId;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getEmpresa(): string
    {
        return $this->empresa;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getUsuariosId(): int
    {
        return $this->usuariosId;
    }

}