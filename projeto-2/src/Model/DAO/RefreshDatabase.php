<?php

namespace Php\Projeto2\Model\DAO;

use PDOException;

class RefreshDatabase
{
    protected $pdo;

    public function __construct()
    {
        $conn = new Conexao();
        $this->pdo = $conn->getConexao();
    }

    public function refreshDatabase()
    {
        try {

            $this->createDatabase();
            $this->dropTables();
            $this->createTables();

        } catch (PDOException $e) {

            throw new PDOException('Erro no refresh database: ' . $e->getMessage());
        }
    }

    private function dropTables()
    {
        $this->dropProdutosTable();
        $this->dropCategoriasTable();
        $this->dropCertificacoesTable();
        $this->dropUsuariosTable();

    }

    private function createTables()
    {
        $this->createCategoriasTable();
        $this->createProdutosTable();
        $this->generateUsuariosTable();
        $this->generateCertificacoesTable();

    }

    private function createDatabase()
    {
        try {
            $sql = "
                CREATE SCHEMA IF NOT EXISTS mydb;
            ";

            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            throw new PDOException('Erro ao excluir tabela **categorias**: ' . $e->getMessage());
        }
    }
    private function dropCategoriasTable()
    {
        try {
            $sql = "
                DROP TABLE IF EXISTS categorias;
            ";

            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            throw new PDOException('Erro ao excluir tabela **categorias**: ' . $e->getMessage());
        }
    }

    private function createCategoriasTable()
    {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS `categorias` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `descricao` VARCHAR(150) NOT NULL,
                  PRIMARY KEY (`id`)
                );
            ";

            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            throw new PDOException('Erro ao criar tabela **categorias**: ' . $e->getMessage());
        }
    }

    private function dropProdutosTable()
    {
        try {
            $sql = "
                DROP TABLE IF EXISTS produtos;
            ";

            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch
        (PDOException $e) {
            throw new PDOException('Erro ao excluir tabela **produtos**: ' . $e->getMessage());
        }
    }

    private
    function createProdutosTable()
    {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS `produtos` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `nome` VARCHAR(150) NOT NULL,
                  `valor` DECIMAL(8,2) NOT NULL,
                  `categorias_id` INT NOT NULL,
                  PRIMARY KEY (`id`),
                  FOREIGN KEY (`categorias_id`)
                  REFERENCES `categorias` (`id`)
                );
            ";

            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch
        (PDOException $e) {
            throw new PDOException('Erro ao criar tabela **produtos**: ' . $e->getMessage());
        }
    }

    private function dropUsuariosTable()
    {
        try {
            $sql = "
                DROP TABLE IF EXISTS usuarios;
            ";

            $stmt = $this->pdo->query($sql);
            $result = $stmt->execute();
            if (!$result) {
                throw new PDOException();
            }
        } catch
        (PDOException $e) {
            throw new PDOException('Erro ao excluir tabela **usuarios**: ' . $e->getMessage());
        }
    }

    private
    function generateUsuariosTable()
    {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS `usuarios` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `nome` VARCHAR(45) NOT NULL,
                  `cpf` CHAR(11) NULL,
                  PRIMARY KEY (`id`)
                );
            ";

            $stmt = $this->pdo->query($sql);
            $result = $stmt->execute();
            $stmt->closeCursor();
            if (!$result) {
                throw new PDOException();
            }
        } catch
        (PDOException $e) {
            throw new PDOException('Erro ao criar tabela **usuarios**: ' . $e->getMessage());
        }
    }

    private function dropCertificacoesTable()
    {
        try {
            $sql = "
                DROP TABLE IF EXISTS certificacoes;
            ";

            $stmt = $this->pdo->query($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            throw new PDOException('Erro ao excluir tabela **certificacoes**: ' . $e->getMessage());
        }
    }

    private
    function generateCertificacoesTable()
    {
        try {
            $sql = "
                CREATE TABLE IF NOT EXISTS `certificacoes` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `titulo` VARCHAR(255) NOT NULL,
                  `descricao` VARCHAR(255) NULL,
                  `empresa` VARCHAR(50) NULL,
                  `usuarios_id` INT NOT NULL,
                  PRIMARY KEY (`id`),
                  FOREIGN KEY (`usuarios_id`)
                  REFERENCES `usuarios` (`id`)
                );
            ";

            $stmt = $this->pdo->query($sql);
            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            throw new PDOException('Erro ao criar tabela **certificacoes**: ' . $e->getMessage());
        }
    }
}