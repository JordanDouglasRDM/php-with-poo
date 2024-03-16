<?php

use pooWithPhp\PlanoCartesiano\Ponto;

require_once 'Ponto.php';

$ponto = new Ponto(3, 4);
echo $ponto->getDistanciaEntrePontos(new Ponto(8, 12)) . PHP_EOL;
echo Ponto::getDistanciaEntrePontosStatic(3,4,10,15) .PHP_EOL;
echo Ponto::$qtdPontos . PHP_EOL;
