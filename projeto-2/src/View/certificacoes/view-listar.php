<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>
<h3 class="text text-center mt-4 mb-4">Listagem de Certificações</h3>
<table class="container table table-striped table-hover mt-3">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Título</th>
        <th scope="col">Descrição</th>
        <th scope="col">Empresa</th>
        <th scope="col">Usuário (nome)</th>
        <th scope="col">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /**@var array $data */

    $certificacoes = $data['model'];

    /**@var \Php\Projeto2\Model\DAO\CertificacaoDao[] $certificacoes */

    foreach ($certificacoes as $produto) {
        echo "<tr>";
        echo "<td>{$produto['id']}</td>";
        echo "<td>{$produto['titulo']}</td>";
        echo "<td>{$produto['descricao']}</td>";
        echo "<td>{$produto['empresa']}</td>";
        echo "<td>{$produto['nome_usuario']}</td>";
        echo '<td>
                <form action="/proj2/certificacoes/excluir" method="post">
                    <input type="hidden" name="certificacao_id" value="'.$produto['id'].'">
                    <input type="submit" class="btn btn-outline-danger" value="x">
                </form>
                </td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>