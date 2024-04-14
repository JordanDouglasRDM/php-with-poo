<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>

<table class="container table table-striped table-hover mt-3">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Valor</th>
        <th scope="col">Categoria_id</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /**@var array $data */

    $produtos = $data['model'];

    /**@var \Php\Projeto2\Model\DAO\ProdutoDAO $produtos */

    foreach ($produtos as $produto) {
        $produto['valor'] = 'R$' . number_format($produto['valor'], 2, ',', '.');
        echo "<tr>";
        echo "<td>{$produto['id']}</td>";
        echo "<td>{$produto['nome']}</td>";
        echo "<td>{$produto['valor']}</td>";
        echo "<td>{$produto['categoria_id']}</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>