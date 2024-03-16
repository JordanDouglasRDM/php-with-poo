<?php
require_once 'Aluno.php';
require_once 'AlunoAds.php';

use pooWithPhp\Aluno\Aluno;
use pooWithPhp\Aluno\AlunoAds;


$a = new Aluno($_POST['nome'], $_POST['idade']);

echo "O nome do Aluno é: '{$a->getNome()}' e possui '{$a->getIdade()}' anos. ";

$ads = new AlunoAds($_POST['nome'], $_POST['idade']);

echo $ads->infoAluno();