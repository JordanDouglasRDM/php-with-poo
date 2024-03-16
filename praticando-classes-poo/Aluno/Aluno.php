<?php

namespace pooWithPhp\Aluno;

class Aluno
{
    protected $nome, $idade;

    public function __construct($nome, $idade)
    {
        $this->setNome($nome);
        $this->setIdade($idade);
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setIdade($idade)
    {
        if ($idade > 0 && $idade < 120) {
            $this->idade = $idade;
        } else {
            $this->idade = 0;
        }
    }
}
