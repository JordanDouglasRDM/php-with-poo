<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>

<table class="container table table-striped table-hover mt-3 w-25">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Descrição</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /**@var array $data */

    $categorias = $data['model'];

    /**@var \Php\Projeto2\Model\DAO\CategoriaDao[] $categorias */

    foreach ($categorias as $categoria) {
        echo "<tr>";
        echo "<td>{$categoria['id']}</td>";
        echo "<td>{$categoria['descricao']}</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>