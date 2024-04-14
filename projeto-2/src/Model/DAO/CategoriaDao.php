<?php
namespace Php\Projeto2\Model\DAO;

use PDO;
use PDOException;
use Php\Projeto2\Model\Domain\Categoria;

class CategoriaDao
{
    private Conexao $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function create(Categoria $categoria): array
    {
        try {
            $sql = "insert into categorias (descricao) value (:descricao)";

            $stmt = $this->conexao->getConexao()->prepare($sql);
            $descricao = $categoria->getDescricao();

            $stmt->bindParam(':descricao', $descricao);

            $result = $stmt->execute();

            if (!$result) {
                throw new PDOException('Erro ao inserir categoria');
            }
            return [
                'success' => true,
                'message' => "Categoria '{$categoria->getDescricao()}' cadastrada com sucesso!",
                'model' => $categoria
            ];

        } catch (PDOException $e) {
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
            $sql = "select * from categorias";

            $stmt = $this->conexao->getConexao()->query($sql);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) < 0) {
                throw new PDOException('Erro ao recuperar lista de categorias');
            }
            return [
                'success' => true,
                'message' => 'Registros encontrados!',
                'model' => $rows
            ];

        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'model' => null
            ];
        }
    }
}