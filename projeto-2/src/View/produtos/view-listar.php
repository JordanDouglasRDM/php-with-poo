<?php
\Php\Projeto2\Helpers\FlashMessage::showMessage();
$categoriaDao = new \Php\Projeto2\Model\DAO\CategoriaDao();
$daoResponse = $categoriaDao->getALl();
$categorias = $daoResponse['model'];

?>
<h3 class="text text-center mt-4 mb-4">Listagem de Produtos</h3>
<div class="container">
    <table class="table table-striped table-hover mt-3 data-table-transform">
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
            echo "<td class='open-modal-produtos' id='{$produto['id']}'>{$produto['id']}</td>";
            echo "<td class='open-modal-produtos' id='{$produto['id']}'>{$produto['nome']}</td>";
            echo "<td class='open-modal-produtos' id='{$produto['id']}'>{$produto['valor']}</td>";
            echo "<td class='open-modal-produtos' id='{$produto['id']}'>{$produto['descricao_categoria']}</td>";
            echo "
                <td>
                    <form action='/proj2/produtos/excluir' method='post' id='{$produto['id']}'>
                        <input type='hidden' name='produto_id' value='{$produto['id']}'>
                        <input type='submit' class='btn btn-outline-danger excluir-produtos' value='x' id='{$produto['id']}'>
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
<?php foreach ($produtos as $produto): ?>
    <div class="modal fade" id="editarProduto<?= $produto['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel1">Dados do produto '<?= $produto['id']?>'</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-<?= $produto['id'] ?>" class="row g-3" method="post" action="/proj2/produtos/alterar/<?= $produto['id'] ?>">
                        <div class="input-group col-md-6">
                            <label for="nome" class="input-group-text">Nome</label>
                            <input type="text" name="nome" class="form-control" id="nome" autofocus value="<?= $produto['nome'] ?>" required>
                        </div>
                        <div class="input-group col-md-6">
                            <label for="valor" class="input-group-text">Valor</label>
                            <input type="number" name="valor" class="form-control" id="valor" step="0.01" value="<?= $produto['valor'] ?>" required>
                        </div>
                        <div class="input-group col-md-6">
                            <label class="input-group-text" for="inputState">Usuarios</label>
                            <select id="inputState" class="form-select" name="categoria_id">
                                <?php foreach ($categorias as $categoria) : ?>
                                    <?php if ($produto['categorias_id'] == $categoria['id']): ?>
                                        <option selected value="<?= $categoria['id']; ?>">
                                            <?= $categoria['descricao']; ?>
                                        </option>
                                    <?php endif; ?>
                                    <option value="<?= $categoria['id']; ?>">
                                        <?= $categoria['descricao']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="form-<?= $produto['id'] ?>" class="btn btn-primary save-changes-produtos">
                        Salvar
                        Alterações
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="/js/produtos/view-listar.js"></script>