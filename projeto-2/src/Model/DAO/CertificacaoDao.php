<?php

namespace Php\Projeto2\Model\DAO;

use Php\Projeto2\Model\Domain\Categoria;
use Php\Projeto2\Model\Domain\Certificacao;

class CertificacaoDao
{
    private Conexao $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function create(Certificacao $certificacao): array
    {
        try {
            $sql = "insert into certificacoes (titulo, descricao, empresa, usuarios_id) VALUES (:titulo, :descricao, :empresa, :usuarios_id)";

            $stmt = $this->conexao->getConexao()->prepare($sql);

            $titulo = $certificacao->getTitulo();
            $descricao = $certificacao->getDescricao();
            $empresa = $certificacao->getEmpresa();
            $usuarios_id = $certificacao->getUsuariosId();

            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':empresa', $empresa);
            $stmt->bindParam(':usuarios_id', $usuarios_id);

            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao inserir certificação');
            }
            return [
                'success' => true,
                'message' => "Certificação '{$certificacao->getTitulo()}' cadastrado com sucesso!",
                'model' => $certificacao
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
            $sql = "select * from certificacoes";

            $stmt = $this->conexao->getConexao()->query($sql);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) < 0) {
                throw new \PDOException('Erro ao recuperar lista de certificações');
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

    public function getALlWithUser(): array
    {
        try {
            $sql = "select c.*, u.nome as 'nome_usuario' from certificacoes c inner join usuarios u on c.usuarios_id = u.id";

            $stmt = $this->conexao->getConexao()->query($sql);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) < 0) {
                throw new \PDOException('Erro ao recuperar lista de certificações');
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

    public function delete(int $certificacaoId): array
    {
        try {

            $sql = 'delete from certificacoes where id = :certificacaoId';
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindParam(':certificacaoId', $certificacaoId);
            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao excluir certificação');
            }

            return [
                'success' => true,
                'message' => 'Certificação excluída com sucesso!',
            ];

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
    public function update(Certificacao $certificacao, int $certificacaoId): array
    {
        try {

            $titulo = $certificacao->getTitulo();
            $descricao = $certificacao->getDescricao();
            $empresa = $certificacao->getEmpresa();

            $sql = 'update certificacoes 
                    set titulo = :titulo, descricao = :descricao, empresa = :empresa  
                    where id = :certificacaoId';
            $stmt = $this->conexao->getConexao()->prepare($sql);

            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':empresa', $empresa);
            $stmt->bindParam(':certificacaoId', $certificacaoId);

            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao atualizar certificação');
            }

            return [
                'success' => true,
                'message' => 'Certificação atualizada com sucesso!',
            ];

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}