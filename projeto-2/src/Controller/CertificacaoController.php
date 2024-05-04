<?php

namespace Php\Projeto2\Controller;

use Php\Projeto2\Helpers\View;
use Php\Projeto2\Model\DAO\CategoriaDao;
use Php\Projeto2\Model\DAO\CertificacaoDao;
use Php\Projeto2\Model\Domain\Certificacao;
use Php\Projeto2\Traits\RedirectToPageTrait;

class CertificacaoController
{
    use RedirectToPageTrait;

    public function create(): void
    {
        try {
            $titulo = filter_input(INPUT_POST, 'titulo');
            $descricao = filter_input(INPUT_POST, 'descricao');
            $empresa = filter_input(INPUT_POST, 'empresa');
            $usuarios_id = filter_input(INPUT_POST, 'usuarios_id', FILTER_VALIDATE_INT);

            $data = [$titulo, $descricao, $empresa, $usuarios_id];

            if (in_array(null, $data)) {
                throw new \Exception('Verifique os campos obrigatórios!');
            }

            $certificacao = new Certificacao($titulo, $descricao, $empresa, $usuarios_id);
            $certificacaoDao = new CertificacaoDao();

            $daoResponse = $certificacaoDao->create($certificacao);

            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');
        }
    }

    public function index()
    {
        try {
            $certificacaoDao = new CertificacaoDao();
            $certificacoes = $certificacaoDao->getALlWithUser();

            $frontController = new FrontController();
            $viewObj = new View('proj2/certificacoes/listar');
            $view = $viewObj->getView();

            return $frontController->renderViewMain($view, $certificacoes);

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');
            exit();
        }
    }

    public function destroy()
    {
        try {
            $certificacaoId = $_POST['certificacao_id'];

            $certificacaoDao = new CertificacaoDao();
            $daoResponse = $certificacaoDao->delete($certificacaoId);

            if (!$daoResponse['success']) {
                throw new \Exception($daoResponse['message']);
            }

            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');
        }
    }
    public function update(array $id): void
    {
        try {
            $titulo = filter_input(INPUT_POST, 'titulo');
            $descricao = filter_input(INPUT_POST, 'descricao');
            $empresa = filter_input(INPUT_POST, 'empresa');

            $data = [$titulo, $descricao, $empresa];

            if (in_array(null, $data)) {
                throw new \Exception('Verifique os campos obrigatórios para atualizar!');
            }

            $certificacao = new Certificacao($titulo, $descricao, $empresa, intval($id[1]));
            $certificacaoDao = new CertificacaoDao();

            $daoResponse = $certificacaoDao->update($certificacao, intval($id[1]));

            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');

        } catch (\Exception $e) {
            $daoResponse = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            $this->redirectTo($daoResponse, '/proj2/certificacoes/listar');
        }
    }
}