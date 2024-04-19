<?php

namespace Php\Projeto2\Model\DAO;

use Php\Projeto2\Model\Domain\Usuario;

class UsuarioDao
{
    private Conexao $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function create(Usuario $usuario): array
    {
        try {
            $sql = "insert into usuarios (nome, cpf) VALUES (:nome, :cpf)";

            $stmt = $this->conexao->getConexao()->prepare($sql);

            $nome = $usuario->getNome();
            $cpf = $usuario->getCpf();

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);

            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao inserir certificação');
            }
            return [
                'success' => true,
                'message' => "Usuário '{$usuario->getNome()}' cadastrado com sucesso!",
                'model' => $usuario
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
            $sql = "SELECT u.*, COUNT(c.id) AS qtd_certificacoes
                        FROM usuarios u LEFT JOIN certificacoes c ON u.id = c.usuarios_id
                        GROUP BY u.id;";

            $stmt = $this->conexao->getConexao()->query($sql);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) < 0) {
                throw new \PDOException('Erro ao recuperar lista de usuários');
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

    public function delete(int $usuarioId): array
    {
        try {

            $sql = 'delete from usuarios where id = :usuarioId';
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindParam(':usuarioId', $usuarioId);
            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao excluir usuário');
            }

            return [
                'success' => true,
                'message' => 'Usuário excluído com sucesso!',
            ];

        } catch (\PDOException $e) {

            if ($e->getCode() == 23000) {
                $message = 'Usuário possui um certificado vinculado, remova-o e tente novamente.';
            } else {
                $message = $e->getMessage();
            }
            return [
                'success' => false,
                'message' => $message,
            ];
        }
    }

}