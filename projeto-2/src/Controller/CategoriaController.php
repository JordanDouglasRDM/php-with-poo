<?php

namespace Php\Projeto2\Controller;

use Php\Projeto2\Helpers\View;
use Php\Projeto2\Model\DAO\CategoriaDao;
use Php\Projeto2\Model\Domain\Categoria;
use Php\Projeto2\Traits\RedirectToPageTrait;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController
{
    use RedirectToPageTrait;

    public function create()
    {
        try {
            $descricao = filter_input(INPUT_POST, 'descricao');

            $categoria = new Categoria($descricao);
            $categoriaDao = new CategoriaDAO();

            $daoResponse = $categoriaDao->create($categoria);

            $this->redirectTo($daoResponse, '/proj2/categorias/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/categorias/listar');
        }
    }

    public function index()
    {
        try {
            $categoriaDao = new CategoriaDAO();
            $categorias = $categoriaDao->getALl();

            $frontController = new FrontController();
            $viewObj = new View('proj2/categorias/listar');
            $view = $viewObj->getView();
        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/categorias/listar');
        }

        return $frontController->renderViewMain($view, $categorias);
    }
    public function destroy()
    {
        try {
            $categoriaId = $_POST['categoria_id'];

            $categoriaDao = new CategoriaDao();
            $daoResponse = $categoriaDao->delete($categoriaId);

            if (!$daoResponse['success']) {
                throw new \Exception($daoResponse['message']);
            }

            $this->redirectTo($daoResponse, '/proj2/categorias/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/categorias/listar');
        }
    }
}
