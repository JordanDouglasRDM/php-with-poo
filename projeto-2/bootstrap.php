<?php

use Php\Projeto2\Controller\CategoriaController;
use Php\Projeto2\Controller\CertificacaoController;
use Php\Projeto2\Controller\FrontController;
use Php\Projeto2\Controller\ProdutoController;
use Php\Projeto2\Controller\SeederController;
use Php\Projeto2\Controller\UsuarioController;
use Php\Projeto2\Router;

require __DIR__ . '/vendor/autoload.php';


$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

$r = new Router($method, $path);

$frontController = new FrontController();
$categoriaController = new CategoriaController();
$produtoController = new ProdutoController();
$certificacaoController = new CertificacaoController();
$usuarioController = new UsuarioController();
$seederController = new SeederController();

$r->get('/', function () {
    header('Location: /proj2/home/dash');
    exit();
});
$r->get('/proj2/{sub}/{view}', [$frontController, 'renderViewMain']);

$r->get('/proj2/categorias/listar', [$categoriaController, 'index']);
$r->post('/proj2/categorias/inserir', [$categoriaController, 'create']);
$r->post('/proj2/categorias/alterar/{id}', [$categoriaController, 'update']);
$r->post('/proj2/categorias/excluir', [$categoriaController, 'destroy']);

$r->get('/proj2/produtos/listar', [$produtoController, 'index']);
$r->post('/proj2/produtos/inserir', [$produtoController, 'create']);
$r->post('/proj2/produtos/alterar/{id}', [$produtoController, 'update']);
$r->post('/proj2/produtos/excluir', [$produtoController, 'destroy']);

$r->get('/proj2/certificacoes/listar', [$certificacaoController, 'index']);
$r->post('/proj2/certificacoes/inserir', [$certificacaoController, 'create']);
$r->post('/proj2/certificacoes/alterar/{id}', [$certificacaoController, 'update']);
$r->post('/proj2/certificacoes/excluir', [$certificacaoController, 'destroy']);

$r->get('/proj2/usuarios/listar', [$usuarioController, 'index']);
$r->post('/proj2/usuarios/inserir', [$usuarioController, 'create']);
$r->post('/proj2/usuarios/alterar/{id}', [$usuarioController, 'update']);
$r->post('/proj2/usuarios/excluir', [$usuarioController, 'destroy']);


$r->get('/proj2/cuidado/execucao/rollback/seeder', [$seederController, 'executeSeedWithRollback']);
$r->get('/proj2/cuidado/execucao/rollback', [$seederController, 'executeRollbackDataBase']);

$result = $r->handler();

if(!$result) {
    http_response_code(404);
    echo 'Página não encontrada!';
    die();
}
echo $result($r->getParams());