<?php

namespace Php\Projeto2\Controller;

use Php\Projeto2\Factory\PopulateCascadeSeedFactory;
use Php\Projeto2\Model\DAO\CategoriaDao;
use Php\Projeto2\Model\DAO\CertificacaoDao;
use Php\Projeto2\Model\DAO\ProdutoDao;
use Php\Projeto2\Model\DAO\RefreshDatabase;
use Php\Projeto2\Model\DAO\UsuarioDao;

class SeederController
{
    protected PopulateCascadeSeedFactory $populateCascadeSeedFactory;

    public function __construct()
    {
        $this->populateCascadeSeedFactory = new PopulateCascadeSeedFactory(
            new RefreshDatabase(),
            new CertificacaoDao(),
            new CategoriaDao(),
            new ProdutoDao(),
            new UsuarioDao(),
        );
    }

    public function executeSeedWithRollback()
    {
        header('Content-Type: application/json');
        try {

            $populateResponse = $this->populateCascadeSeedFactory->seedWithRollBack();

            if (!$populateResponse['success']) {
                throw new \Exception($populateResponse['message']);
            }

            http_response_code(200);

            return json_encode($populateResponse);

        } catch (\Exception $e) {

            http_response_code(500);
            return json_encode(['message' => $e->getMessage()]);
        }
    }

    public function executeRollbackDataBase()
    {
        header('Content-Type: application/json');
        try {
            $populateResponse = $this->populateCascadeSeedFactory->rollBackDatabase();

            if (!$populateResponse['success']) {
                throw new \Exception($populateResponse['message']);
            }

            http_response_code(200);

            return json_encode($populateResponse);

        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['message' => $e->getMessage()]);
        }
    }
}