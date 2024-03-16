<?php
require_once '..\config.php';
function deleteById(int $id)
{
    try {
        global $pdo;
        $sql = "DELETE FROM alunos WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['message'] = 'Aluno excluido com sucesso.';
        $_SESSION['type_message'] = 'success';
        header('Location: /../aula-1/index.php');
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $_SESSION['message'] = 'O aluno possui professor, e por isso não pôde ser excluído.';
        } else {
            $_SESSION['message'] = $e->getMessage();
        }
        $_SESSION['type_message'] = 'danger';
        header('Location: /../aula-1/index.php');
        exit();
    }
}

if ($_GET) {
    try {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (empty($id)) {
            throw new Exception("O 'id' do aluno é obrigatório.");
        }
        deleteById($id);
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ../aula-1/index.php');
    }
} else {
    $_SESSION['message'] = 'Acesso negado!';
    $_SESSION['type_message'] = 'warning';
    header('Location: ../aula-1/index.php');
    exit();
}