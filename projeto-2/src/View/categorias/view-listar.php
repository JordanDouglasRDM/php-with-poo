<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>
<h3 class="text text-center mt-4 mb-4">Listagem de Categorias</h3>
<table class="container table table-striped table-hover mt-3 w-25">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Descrição</th>
        <th scope="col">Ações</th>
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
        echo '<td>
                <form action="/proj2/categorias/excluir" method="post">
                    <input type="hidden" name="categoria_id" value="'. $categoria['id'] .'">
                    <input type="submit" class="btn btn-outline-danger" value="x">
                </form>
                </td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>