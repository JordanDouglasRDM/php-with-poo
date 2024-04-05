<?php

namespace Php\PrimeiroProjeto\Controller;

use JetBrains\PhpStorm\NoReturn;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Files\IncludingFileSniff;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListaDoisExerciciosController
{
    public function renderViewMain(array $view): string
    {
        $viewContent = $this->renderView($view[1]);
        $layoutContent = $this->renderLayout($viewContent);

        $response = new Response($layoutContent);

        return $response->getContent();
    }

    #[NoReturn] public function one(): void
    {
        $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_FLOAT);
        $result = null;

        if ($number > 0) {
            $result = 'Valor Positivo';
        } elseif ($number < 0) {
            $result = 'Valor Negativo';
        } elseif ($number === 0) {
            $result = 'Igual a 0';
        }
        $_SESSION['message'] = $result;
        header('Location: /lista2/ex1');
        exit();
    }

    #[NoReturn] public function two(): void
    {
        $numbers = filter_input(INPUT_POST, 'numbers');
        $arrayNumber = explode(',', $numbers);
        $arrayNumberInitial = $arrayNumber;
        rsort($arrayNumber);

        $position = array_search($arrayNumber[0], $arrayNumberInitial);

        $result = "O maior número digitado é: '{$arrayNumber[0]}' e ao inserir, ele estava na posição '$position'";

        $_SESSION['message'] = $result;
        header('Location: /lista2/ex2');
        exit();
    }

    #[NoReturn] public function three(): void
    {
        $number1 = filter_input(INPUT_POST, 'number1', FILTER_VALIDATE_FLOAT);
        $number2 = filter_input(INPUT_POST, 'number2', FILTER_VALIDATE_FLOAT);

        if ($number2 === $number1) {
            $soma = ($number1 * 2) * 3;
            $result = "Os números são iguais, então, o triplo da soma é: '{$soma}'.";
        } else {
            $soma = ($number1 + $number2);
            $result = "{$number1} + {$number2} = {$soma}.";
        }

        $_SESSION['message'] = $result;
        header('Location: /lista2/ex3');
        exit();
    }

    #[NoReturn] public function four(): void
    {
        $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_FLOAT);

        $result = "tabuada do número {$number}:";
        $tabuada = '';

        for ($i = 0; $i < 11; $i++) {
            $calc = $i * $number;

            $tabuada .= "<li class='list-group-item'> {$number} X {$i} = {$calc} </li>";
        }


        $_SESSION['message'] = $result;
        $_SESSION['tabuada'] = $tabuada;

        header('Location: /lista2/ex4');
        exit();
    }

    #[NoReturn] public function five(): void
    {
        $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_FLOAT);
        $fat = gmp_fact($number);

        $_SESSION['message'] = "O fatorial de {$number} é: {$fat}";

        header('Location: /lista2/ex5');
        exit();
    }

    #[NoReturn] public function six(): void
    {
        $number1 = filter_input(INPUT_POST, 'number1', FILTER_VALIDATE_FLOAT);
        $number2 = filter_input(INPUT_POST, 'number2', FILTER_VALIDATE_FLOAT);

        $result = null;

        if ($number1 > $number2) {
            $result = "$number2 $number1";
        } elseif ($number1 < $number2) {
            $result = "$number1 $number2";
        } elseif ($number2 === $number1) {
            $result = "Números iguais: $number1";
        }

        $_SESSION['message'] = $result;

        header('Location: /lista2/ex6');
        exit();
    }
    #[NoReturn] public function seven(): void
    {
        $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_FLOAT);

        $calc = $number * 1000;
        $result = "$number metros, em mílimetros é: $calc";

        $_SESSION['message'] = $result;

        header('Location: /lista2/ex7');
        exit();

    }
    #[NoReturn] public function eight(): void
    {
        $metrosQuadrado = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_FLOAT);
        $metrosQuadrado = number_format($metrosQuadrado, 2, ',');

        $metrosPorLitro = 3;
        $precoPorLata = 80;
        $litrosPorLata = 18;

        $rendimentoLataMetros = ceil($litrosPorLata * $metrosPorLitro);
        $qtdLatas = ceil($metrosQuadrado / $rendimentoLataMetros);
        $precoTotal = number_format($qtdLatas * $precoPorLata, 2, ',');

        $result = "É necessário {$qtdLatas} latas para pintar {$metrosQuadrado}M². Preço total R$ {$precoTotal}";

        $_SESSION['message'] = $result;

        header('Location: /lista2/ex8');
        exit();

    }
    #[NoReturn] public function nine(): void
    {
        $anoNascimento = filter_input(INPUT_POST, 'anoNascimento', FILTER_VALIDATE_INT);
        $anoAtual = date('Y');

        $idadeEmAnos = $anoAtual - $anoNascimento;
        $diasVividos = floor($idadeEmAnos * 365);
        $anosEm2025 = 2025 - $anoNascimento;

        $result = "Cálculos realizados";

        $idades = "
            <li class='list-group-item'>Idade em anos: $idadeEmAnos</li>
            <li class='list-group-item'>Dias vividos: $diasVividos</li>
            <li class='list-group-item'>Em 2025, terá : $anosEm2025 anos</li>        
        ";


        $_SESSION['message'] = $result;
        $_SESSION['idades'] = $idades;

        header('Location: /lista2/ex9');
        exit();
    }
    #[NoReturn] public function ten(): void
    {
        $height = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_FLOAT);
        $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);

        $imc = number_format($weight / ($height ** 2), '2',',');
        if ($imc < 18.5) {
            $level = 1;
        } elseif ($imc >= 18.5 && $imc <= 24.9) {
            $level = 2;
        } elseif ($imc >= 25.0 && $imc <= 29.9) {
            $level = 3;
        } elseif ($imc >= 30.0 && $imc <= 39.9) {
            $level = 4;
        } else {
            $level = 5;
        }

        $_SESSION['message'] = "Seu IMC é: $imc";
        $_SESSION['level'] = $level;

        header('Location: /lista2/ex10');
        exit();
    }

    private function renderLayout(string $content): string
    {
        ob_start();
        include_once(__DIR__ . '/../View/layout.php');
        return ob_get_clean();
    }

    private function renderView(string $view): string
    {
        ob_start();
        include_once(__DIR__ . '/../View/view-' . $view . '.php');
        return ob_get_clean();
    }

}
