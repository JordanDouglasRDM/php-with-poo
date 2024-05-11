<?php

use Php\Projeto2\Model\DAO\CertificacaoDao;

\Php\Projeto2\Helpers\FlashMessage::showMessage();
$usuario = new \Php\Projeto2\Model\DAO\UsuarioDao();
$daoResponse = $usuario->getALl();
$usuarios = $daoResponse['model'];

?>
<h3 class="text text-center mt-4 mb-4">Listagem de Certificações</h3>
<div class="container">
    <table class="table table-striped table-hover mt-3 data-table-transform">
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

        /**@var CertificacaoDao[] $certificacoes */

        foreach ($certificacoes as $certificado) {
            echo "<tr>";
            echo "<td id='{$certificado['id']}' class='open-modal-certificacoes'>{$certificado['id']}</td>";
            echo "<td id='{$certificado['id']}' class='open-modal-certificacoes'>{$certificado['titulo']}</td>";
            echo "<td id='{$certificado['id']}' class='open-modal-certificacoes'>{$certificado['descricao']}</td>";
            echo "<td id='{$certificado['id']}' class='open-modal-certificacoes'>{$certificado['empresa']}</td>";
            echo "<td id='{$certificado['id']}' class='open-modal-certificacoes'>{$certificado['nome_usuario']}</td>";
            echo "
                <td>
                    <form action='/proj2/certificacoes/excluir' id='{$certificado['id']}' method='post'>
                        <input type='hidden' name='certificacao_id' value='{$certificado['id']}'>
                        <input type='submit' class='btn btn-outline-danger excluir-certificacao' id='{$certificado['id']}' value='x'>
                    </form>
                </td>
              ";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<!--Define todas as minhas modal para exibir os dados para edição dos usuários-->
<?php foreach ($certificacoes as $certificado): ?>
    <div class="modal fade" id="editarCertificacao<?= $certificado['id'] ?>" tabindex="-1"
         aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel1">Dados do certificado '<?= $certificado['id'] ?>
                        '</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-<?= $certificado['id'] ?>" class="row g-3" method="post"
                          action="/proj2/certificacoes/alterar/<?= $certificado['id'] ?>" style="margin-top: 60px">
                        <div class="input-group col-md-6">
                            <label for="titulo" class="input-group-text">Titulo</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" autofocus
                                   value="<?= $certificado['titulo'] ?>" required>
                        </div>
                        <div class="input-group col-md-6">
                            <label for="descricao" class="input-group-text">Descrição</label>
                            <input type="text" name="descricao" class="form-control" id="descricao"
                                   value="<?= $certificado['descricao'] ?>" required>
                        </div>
                        <div class="input-group col-md-6">
                            <label for="empresa" class="input-group-text">Empresa</label>
                            <input type="text" name="empresa" class="form-control" id="empresa"
                                   value="<?= $certificado['empresa'] ?>" required>
                        </div>
                        <div class="input-group col-md-6">
                            <label class="input-group-text" for="inputState">Usuarios</label>
                            <select id="inputState" class="form-select" name="" disabled>
                                <?php foreach ($usuarios as $usuario) : ?>
                                    <?php if ($certificado['usuarios_id'] == $usuario['id']): ?>
                                        <option selected><?= $usuario['nome']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="form-<?= $certificado['id'] ?>"
                            class="btn btn-primary save-changes-certificacoes">
                        Salvar
                        Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="/js/certificacoes/view-listar.js"></script>
