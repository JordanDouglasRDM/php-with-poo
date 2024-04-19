<?php

namespace Php\Projeto2\Model\DAO;

use Php\Projeto2\Model\Domain\Produto;

class ProdutoDao
{
    private Conexao $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function create(Produto $produto): array
    {
        try {
            $sql = "insert into produtos (nome, valor, categorias_id) VALUES (:nome, :valor, :categorias_id)";

            $stmt = $this->conexao->getConexao()->prepare($sql);

            $nome = $produto->getNome();
            $valor = $produto->getValor();
            $categoriaId = $produto->getCategoriasId();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':categorias_id', $categoriaId);

            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao inserir produto');
            }
            return [
                'success' => true,
                'message' => "Produto '{$produto->getNome()}' cadastrado com sucesso!",
                'model' => $produto
            ];

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'model' => null
            ];
        }
    }

    public function getALl(): array
    {
        try {
            $sql = "select * from produtos";

            $stmt = $this->conexao->getConexao()->query($sql);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) < 0) {
                throw new \PDOException('Erro ao recuperar lista de produtos');
            }
            return [
                'success' => true,
                'message' => 'Registros encontrados!',
                'model' => $rows
            ];

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'model' => null
            ];
        }
    }

    public function getALlWithCategory(): array
    {
        try {
            $sql = "select p.*, c.descricao as 'descricao_categoria' from produtos p inner join categorias c on p.categorias_id = c.id";

            $stmt = $this->conexao->getConexao()->query($sql);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) < 0) {
                throw new \PDOException('Erro ao recuperar lista de produtos');
            }
            return [
                'success' => true,
                'message' => 'Registros encontrados!',
                'model' => $rows
            ];

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'model' => null
            ];
        }
    }

    public function delete(int $produtoId): array
    {
        try {
            $sql = 'delete from produtos where id = :produtoId';
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindParam(':produtoId', $produtoId);
            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao excluir produto');
            }

            return [
                'success' => true,
                'message' => 'Produto excluído com sucesso!',
            ];

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}