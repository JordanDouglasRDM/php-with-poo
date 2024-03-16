<?php
require_once '..\config.php';

function updateProfessor(array $data)
{
    global $pdo;
    $sql = "UPDATE professores SET nome = :nome, formacao = :formacao, telefone = :telefone, email = :email, aluno_id = :aluno_id WHERE id = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $data['nome']);
    $stmt->bindParam(':formacao', $data['formacao']);
    $stmt->bindParam(':telefone', $data['telefone']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':aluno_id', $data['aluno_id']);
    $stmt->bindParam(':id', $data['id']);
    $stmt->execute();
    header('Location: ./home-professor.php?update=ok');
    exit();
}
if ($_POST) {
    $data['nome'] = filter_input(INPUT_POST,'nome');
    $data['formacao'] = filter_input(INPUT_POST,'formacao');
    $data['telefone'] = filter_input(INPUT_POST,'telefone', FILTER_VALIDATE_INT);
    $data['email'] = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
    $data['aluno_id'] = filter_input(INPUT_POST,'aluno_id', FILTER_VALIDATE_INT);
    $data['id'] = filter_input(INPUT_POST,'id', FILTER_VALIDATE_INT);
    updateProfessor($data);
} else {
    header('Location: ./home-professor.php?forbidden=ok');
    exit();
}
?>