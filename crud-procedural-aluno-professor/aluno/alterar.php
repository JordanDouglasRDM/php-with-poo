<?php
require_once '..\config.php';

function updateAluno(array $data)
{
    try {
        global $pdo;
        $sql = "UPDATE alunos SET nome = :nome, curso = :curso WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':curso', $data['curso']);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();

        $_SESSION['message'] = 'Aluno atualizado com sucesso.';
        $_SESSION['type_message'] = 'success';
        header('Location: ../aula-1/index.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ../aula-1/index.php');
    }
}

if ($_POST) {
    try {
        $data['id'] = filter_input(INPUT_POST, 'id');
        $data['nome'] = filter_input(INPUT_POST, 'nome');
        $data['curso'] = filter_input(INPUT_POST, 'curso');
        if (empty($data['id'])) {
            throw new Exception('O id do aluno é obrigatório.');
        }

        updateAluno($data);
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ../aula-1/index.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Acesso negado!';
    $_SESSION['type_message'] = 'warning';
    header('Location: ../aula-1/index.php');
    exit();
}
?>