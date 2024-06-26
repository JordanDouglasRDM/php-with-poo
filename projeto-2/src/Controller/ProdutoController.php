<?php

namespace Php\Projeto2\Controller;

use Php\Projeto2\Helpers\View;
use Php\Projeto2\Model\DAO\ProdutoDao;
use Php\Projeto2\Model\Domain\Produto;
use Php\Projeto2\Traits\RedirectToPageTrait;

class ProdutoController
{
    use RedirectToPageTrait;

    public function create(): void
    {
        try {
            $nome = filter_input(INPUT_POST, 'nome');
            $valor = filter_input(INPUT_POST, 'valor');
            $categoriaId = filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT);

            $data = [$nome, $valor, $categoriaId];
            if (in_array(null, $data)) {
                throw new \Exception('Verifique os campos obrigatórios!');
            }

            $produto = new Produto($nome, $valor, $categoriaId);
            $produtoDao = new ProdutoDao();

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
    public function update(array $id): void
    {
        try {
            $nome = filter_input(INPUT_POST, 'nome');
            $valor = filter_input(INPUT_POST, 'valor');
            $categoriaId = filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT);

            $data = [$nome, $valor, $categoriaId];

            if (in_array(null, $data)) {
                throw new \Exception('Verifique os campos obrigatórios!');
            }

            $produto = new Produto($nome, $valor, $categoriaId);
            $produtoDao = new ProdutoDao();

            $daoResponse = $produtoDao->update($produto, intval($id[1]));

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
            $produtoDao = new ProdutoDao();
            $produtos = $produtoDao->getALlWithCategory();

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
    public function destroy()
    {
        try {
            $produtoId = $_POST['produto_id'];

            $produtoDao = new ProdutoDao();
            $daoResponse = $produtoDao->delete($produtoId);

            if (!$daoResponse['success']) {
                throw new \Exception($daoResponse['message']);
            }

            $this->redirectTo($daoResponse, '/proj2/produtos/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/produtos/listar');
        }
    }
}