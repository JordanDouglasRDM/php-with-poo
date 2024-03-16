<?php
require_once '../config.php';

function setAluno(array $data)
{
    try {
        global $pdo;
        $sql = "INSERT INTO alunos (nome, curso) VALUES (:nome, :curso);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':curso', $data['curso']);
        $stmt->execute();
        $_SESSION['message'] = 'Aluno cadastrado com sucesso.';
        $_SESSION['type_message'] = 'success';
        header('Location: ../aula-1/index.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ../aula-1/index.php');
        exit();
    }
}

if ($_POST) {
    try {
        $data['nome'] = filter_input(INPUT_POST, 'nome');
        $data['curso'] = filter_input(INPUT_POST, 'curso');
        foreach ($data as $key => $value) {
            if (empty($value)) {
                throw new Exception("O campo '$key' é obrigatório.");
            }
        }

        setAluno($data);
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