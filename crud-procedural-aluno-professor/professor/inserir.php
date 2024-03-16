<?php
require_once '../config.php';

function setProfessor(array $data)
{
    try {
        global $pdo;
        $sql = "INSERT INTO professores  (nome, formacao, telefone, email, aluno_id) VALUES (:nome, :formacao, :telefone, :email, :aluno_id);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':formacao', $data['formacao']);
        $stmt->bindParam(':telefone', $data['telefone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':aluno_id', $data['aluno_id']);
        $stmt->execute();
        $_SESSION['message'] = 'Professor cadastrado com sucesso.';
        $_SESSION['type_message'] = 'success';
        header('Location: ../aula-1/professor/home-professor.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ../aula-1/professor/home-professor.php');
        exit();
    }
}

if ($_POST) {
    try {
        $data['nome'] = filter_input(INPUT_POST, 'nome');
        $data['formacao'] = filter_input(INPUT_POST, 'formacao');
        $data['telefone'] = filter_input(INPUT_POST, 'telefone', FILTER_VALIDATE_INT);
        $data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $data['aluno_id'] = filter_input(INPUT_POST, 'aluno_id', FILTER_VALIDATE_INT);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                throw new Exception("O campo '$key' é obrigatório.");
            }
        }
        setProfessor($data);
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: /aula-1/professor/home-professor.php');
    }
} else {
    $_SESSION['message'] = 'Acesso negado!';
    $_SESSION['type_message'] = 'warning';
    header('Location: /aula-1/professor/home-professor.php');
    exit();
}