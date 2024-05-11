<?php

use Php\Projeto2\Model\DAO\CategoriaDao;

\Php\Projeto2\Helpers\FlashMessage::showMessage();
?>
<h3 class="text text-center mt-4 mb-4">Listagem de Categorias</h3>
<div class="container">
    <table class="table table-striped table-hover mt-3 data-table-transform">
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

        /**@var CategoriaDao[] $categorias */

        foreach ($categorias as $categoria) {
            echo "<tr>";
            echo "<td class='open-modal-categorias' id='{$categoria['id']}'>{$categoria['id']}</td>";
            echo "<td class='open-modal-categorias' id='{$categoria['id']}'>{$categoria['descricao']}</td>";
            echo "<td id='{$categoria['id']}'>
                <form action='/proj2/categorias/excluir' method='post' id='{$categoria['id']}'>
                    <input type='hidden' name='categoria_id' value='{$categoria['id']}'>
                    <input type='submit' class='btn btn-outline-danger excluir-categorias' value='x' id='{$categoria['id']}'>
                </form>
                </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<!--Define todas as minhas modal para exibir os dados para edição das categorias-->
<?php foreach ($categorias as $categoria): ?>
    <div class="modal fade" id="editarCategoria<?= $categoria['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel1">Dados da categoria '<?= $categoria['id']?>'</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-<?= $categoria['id'] ?>" class="row g-3" method="post" action="/proj2/categorias/alterar/<?= $categoria['id'] ?>">
                        <div class="input-group col-md-6">
                            <label for="descricao" class="input-group-text">Descrição</label>
                            <input type="text" name="descricao" class="form-control" id="descricao" value="<?= $categoria['descricao']?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="form-<?= $categoria['id'] ?>" class="btn btn-primary save-changes-categorias">
                        Salvar
                        Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="/js/categorias/view-listar.js"></script>