<?php

namespace Php\Projeto2\Controller;

use Php\Projeto2\Helpers\View;
use Php\Projeto2\Model\DAO\ProdutoDAO;
use Php\Projeto2\Model\Domain\Produto;
use Php\Projeto2\Traits\RedirectToPage;

class ProdutoController
{
    use RedirectToPage;

    public function create(): void
    {
        try {
            $nome = filter_input(INPUT_POST, 'nome');
            $valor = filter_input(INPUT_POST, 'valor');
            $descricaoCategoria = filter_input(INPUT_POST, 'descricao_categoria');

            $produto = new Produto($nome, $valor, $descricaoCategoria);
            $produtoDao = new ProdutoDAO();

            $daoResponse = $produtoDao->create($produto);

            $this->redirectTo($daoResponse, '/proj2/produtos/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/produtos/listar');
        }
    }

    public function index()
    {
        try {
            $produtoDao = new ProdutoDAO();
            $produtos = $produtoDao->getALl();

            $frontController = new FrontController();
            $viewObj = new View('proj2/produtos/listar');
            $view = $viewObj->getView();

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/produtos/listar');
        }

        return $frontController->renderViewMain($view, $produtos);
    }
}