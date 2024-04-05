<?phpuse Php\PrimeiroProjeto\Controller\ListaDoisExerciciosController;use Php\PrimeiroProjeto\Router;require __DIR__ . '/vendor/autoload.php';$method = $_SERVER['REQUEST_METHOD'];$path = $_SERVER['PATH_INFO'] ?? '/';$r = new Router($method, $path);$r->get('/olamundo', function () {    return 'Olá mundo!';});$r->get('/olapessoa/{nome}', function ($params){    return "Olá {$params[1]}";});$r->get('/ex1/formulario', function (){    include 'public/ex1.html';});$r->post('/ex1/resposta', function (){    $valor1 = filter_input(INPUT_POST, 'valor1');    $valor2 = filter_input(INPUT_POST, 'valor2');    $soma = $valor2 + $valor1;    return "A soma é: {$soma}";});$controller = new ListaDoisExerciciosController();$r->get('/lista2/{view}', [$controller, 'renderViewMain']);$r->post('/lista2/ex1/resposta', [$controller, 'one']);$r->post('/lista2/ex2/resposta', [$controller, 'two']);$r->post('/lista2/ex3/resposta', [$controller, 'three']);$r->post('/lista2/ex4/resposta', [$controller, 'four']);$r->post('/lista2/ex5/resposta', [$controller, 'five']);$r->post('/lista2/ex6/resposta', [$controller, 'six']);$r->post('/lista2/ex7/resposta', [$controller, 'seven']);$r->post('/lista2/ex8/resposta', [$controller, 'eight']);$r->post('/lista2/ex9/resposta', [$controller, 'nine']);$r->post('/lista2/ex10/resposta', [$controller, 'ten']);$result = $r->handler();if(!$result) {    http_response_code(404);    echo "Página não encontrada!";    die();}echo $result($r->getParams());