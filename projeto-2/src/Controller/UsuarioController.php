<?php

namespace Php\Projeto2\Controller;

use Php\Projeto2\Helpers\View;
use Php\Projeto2\Model\DAO\UsuarioDao;
use Php\Projeto2\Model\Domain\Usuario;
use Php\Projeto2\Traits\RedirectToPageTrait;

class UsuarioController
{
    use RedirectToPageTrait;

    public function create(): void
    {
        try {
            $nome = filter_input(INPUT_POST, 'nome');
            $cpf = filter_input(INPUT_POST, 'cpf');

            $data = [$nome];
            if (in_array(null, $data)) {
                throw new \Exception('Verifique os campos obrigatórios!');
            }

            $usuario = new Usuario($nome, $cpf);
            $usuarioDao = new UsuarioDao();

            $daoResponse = $usuarioDao->create($usuario);

            $this->redirectTo($daoResponse, '/proj2/usuarios/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/usuarios/listar');
        }
    }

    public function index()
    {
        try {
            $usuarioDao = new UsuarioDao();
            $usuarios = $usuarioDao->getALl();

            $frontController = new FrontController();
            $viewObj = new View('proj2/usuarios/listar');
            $view = $viewObj->getView();

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/usuarios/listar');
        }

        return $frontController->renderViewMain($view, $usuarios);
    }
    public function destroy()
    {
        try {
            $usuarioId = $_POST['usuario_id'];

            $usuarioDao = new UsuarioDao();
            $daoResponse = $usuarioDao->delete($usuarioId);

            if (!$daoResponse['success']) {
                throw new \Exception($daoResponse['message']);
            }

            $this->redirectTo($daoResponse, '/proj2/usuarios/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/usuarios/listar');
        }
    }

}