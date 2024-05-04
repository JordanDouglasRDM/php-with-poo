<?php

use Php\Projeto2\Model\DAO\UsuarioDao;

\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>
<h3 class="text text-center mt-4 mb-4">Listagem de Usuários</h3>
<div class="container">
    <table class="table table-striped table-hover mt-3 text-center data-table-transform">
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

        /**@var UsuarioDao[] $usuarios */

        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td id='{$usuario['id']}' class='open-modal'>{$usuario['id']}</td>";
            echo "<td id='{$usuario['id']}' class='open-modal'>{$usuario['nome']}</td>";
            echo "<td id='{$usuario['id']}' class='open-modal'>{$usuario['cpf']}</td>";
            echo "<td id='{$usuario['id']}' class='open-modal'>{$usuario['qtd_certificacoes']}</td>";
            echo "<td>
                        <form action='/proj2/usuarios/excluir' method='post' id='excluir-usuario-{$usuario['id']}'>
                            <input type='hidden' name='usuario_id' value='{$usuario['id']}'>
                            <input type='submit' class='btn btn-outline-danger excluir-usuario' value='x'>
                        </form>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<!--Define todas as minhas modal para exibir os dados para edição dos usuários-->
<?php foreach ($usuarios as $usuario): ?>
    <div class="modal fade" id="editarUsuario<?= $usuario['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Dados Usuário - <?= $usuario['nome'] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="form-<?= $usuario['id'] ?>" method="post"
                          action="/proj2/usuarios/alterar/<?= $usuario['id'] ?>">
                        <div class="input-group col-md-6">
                            <label for="nome" class="input-group-text">Nome</label>
                            <input type="text" name="nome" class="form-control" id="nome" required
                                   value="<?= $usuario['nome'] ?>">
                        </div>
                        <div class="input-group col-md-6">
                            <label for="cpf" class="input-group-text">CPF</label>
                            <input type="text" name="cpf" class="form-control" id="cpf" maxlength="11" minlength="11"
                                   value="<?= $usuario['cpf'] ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="form-<?= $usuario['id'] ?>" class="btn btn-primary save-changes">Salvar
                        Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    const meusTd = document.querySelectorAll('.open-modal');
    const saveChangesButtons = document.querySelectorAll('.save-changes');
    const deleteButtons = document.querySelectorAll('.excluir-usuario');


    //define o click na linha para abrir o modal de edição
    meusTd.forEach((td) => {
        td.setAttribute('data-bs-toggle', 'modal');
        td.setAttribute('data-bs-target', '#editarUsuario' + td.id);
        td.style.cursor = 'pointer';
    });

    //adiciona uma confirmação de exclusão
    deleteButtons.forEach((bt) => {
        bt.addEventListener('click', function (event) {
            event.preventDefault();
            const form = bt.closest('form');
            confirmarExclusao(form);
        })
    });

    //envia o formulário para alterar um usuário
    saveChangesButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const form = document.getElementById(button.id);
            form.submit();
        })
    });

</script>
