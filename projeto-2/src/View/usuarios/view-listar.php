<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>
<h3 class="text text-center mt-4 mb-4">Listagem de Usuários</h3>
<table class="container table table-striped table-hover mt-3 text-center">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Qtd Certificações</th>
        <th scope="col">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /**@var array $data */

    $usuarios = $data['model'];

    /**@var \Php\Projeto2\Model\DAO\UsuarioDao[] $usuarios */

    foreach ($usuarios as $usuario) {
        echo "<tr>";
        echo "<td>{$usuario['id']}</td>";
        echo "<td>{$usuario['nome']}</td>";
        echo "<td>{$usuario['cpf']}</td>";
        echo "<td>{$usuario['qtd_certificacoes']}</td>";
        echo '<td>
                <form action="/proj2/usuarios/excluir" method="post">
                    <input type="hidden" name="usuario_id" value="'. $usuario['id'] .'">
                    <input type="submit" class="btn btn-outline-danger" value="x">
                </form>
                </td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>