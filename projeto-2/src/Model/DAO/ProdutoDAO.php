<?php

namespace Php\Projeto2\Model\DAO;

use Php\Projeto2\Model\Domain\Produto;

class ProdutoDAO
{
    private Conexao $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function create(Produto $produto): array
    {
        try {
            $sql = "insert into produtos (nome, valor, categoria_id) VALUES (:nome, :valor, :categoria_id)";

            $stmt = $this->conexao->getConexao()->prepare($sql);

            $nome = $produto->getNome();
            $valor = $produto->getValor();
            $categoriaId = $produto->getCategoriaId();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':categoria_id', $categoriaId);

            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao inserir produto');
            }
            return [
                'success' => true,
                'message' => "Categoria '{$produto->getNome()}' cadastrado com sucesso!",
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
                throw new \PDOException('Erro ao recuperar lista de categorias');
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
}