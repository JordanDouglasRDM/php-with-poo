<?php
require_once '..\config.php';
function deleteById(int $id)
{
    try {
        global $pdo;
        $sql = "DELETE FROM professores WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['message'] = 'Professor excluido com sucesso.';
        $_SESSION['type_message'] = 'success';
        header('Location: ./home-professor.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: /../aula-1/index.php');
        exit();
    }
}

if ($_GET && $_GET['id']) {
    $id = filter_input(INPUT_GET, 'id');
    deleteById($id);
} else {
    header('Location: ./home-professor.php?forbidden=ok');
    exit();
}