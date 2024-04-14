<?php

namespace Php\Projeto2\Model\DAO;

use PDOException;

class Conexao
{
    private \PDO $conexao;
    public function __construct()
    {
        $this->setConexao();
    }
    public function getConexao()
    {
        return $this->conexao;
    }
    private function setConexao(): void
    {
        try {
            $dsn = 'mysql:dbname=mydb;host=localhost';

            $this->conexao = new \PDO($dsn, 'root', 'admin');


        } catch (PDOException $exception) {

            throw new PDOException($exception->getMessage());
        }
    }

}