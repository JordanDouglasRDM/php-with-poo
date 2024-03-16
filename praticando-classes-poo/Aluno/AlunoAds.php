<?php

namespace pooWithPhp\Aluno;

final class AlunoAds extends Aluno
{
    public function infoAluno(): string
    {
        return "Olá! Meu nome é {$this->nome} e sou do ADS!";
    }
}