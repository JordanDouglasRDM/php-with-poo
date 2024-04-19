<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>
<h3 class="text text-center mt-4 mb-4">Listagem de Produtos</h3>
<table class="container table table-striped table-hover mt-3">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Valor</th>
        <th scope="col">Categoria (descrição)</th>
        <th scope="col">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /**@var array $data */

    $produtos = $data['model'];

    /**@var \Php\Projeto2\Model\DAO\ProdutoDao $produtos */

    foreach ($produtos as $produto) {
        $produto['valor'] = 'R$' . number_format($produto['valor'], 2, ',', '.');
        echo "<tr>";
        echo "<td>{$produto['id']}</td>";
        echo "<td>{$produto['nome']}</td>";
        echo "<td>{$produto['valor']}</td>";
        echo "<td>{$produto['descricao_categoria']}</td>";
        echo '<td>
                <form action="/proj2/produtos/excluir" method="post">
                    <input type="hidden" name="produto_id" value="'. $produto['id'] .'">
                    <input type="submit" class="btn btn-outline-danger" value="x">
                </form>
                </td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>