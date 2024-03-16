<?php

namespace pooWithPhp\PlanoCartesiano;

class Ponto
{
    private $x, $y;
    private float $distanciaEntrePontos;
    public static int $qtdPontos = 0;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
        self::$qtdPontos++;
    }

    public static function getDistanciaEntrePontosStatic(float $x1, float $y1, float $x2, float $y2): float
    {
        $delta = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
        return number_format($delta, 2);
    }

    public static function getQtdPontos(): int
    {
        return self::$qtdPontos;
    }

    public function getDistanciaEntrePontos(Ponto $ponto): float
    {
        $delta = sqrt(pow($ponto->x - $this->x, 2) + pow($ponto->y - $this->y, 2));
        $this->distanciaEntrePontos = $delta;
        return number_format($this->distanciaEntrePontos, 2);
    }

    public function getDistanciaEntreCoordenadas(float $x, float $y): float
    {
        $delta = sqrt(pow($x - $this->x, 2) + pow($y - $this->y, 2));
        $this->distanciaEntrePontos = $delta;
        return number_format($this->distanciaEntrePontos, 2);
    }

}