<?php
$categoriaDao = new \Php\Projeto2\Model\DAO\CategoriaDao();
$daoResponse = $categoriaDao->getALl();
$categorias = $daoResponse['model'];

?>
<div class="container w-50 border border-secondary mt-3 pb-3">
    <h3 class="text text-center mt-3">Adicinar Novo Produto</h3>
    <form class="row g-3" method="post" action="/proj2/produtos/inserir" style="margin-top: 60px">
        <div class="input-group col-md-6">
            <label for="nome" class="input-group-text">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome" autofocus required>
        </div>
        <div class="input-group col-md-6">
            <label for="valor" class="input-group-text">Valor</label>
            <input type="number" name="valor" class="form-control" id="valor" step="0.01" required>
        </div>
        <div class="input-group col-md-6">
            <label class="input-group-text" for="inputState">Categorias</label>
            <select id="inputState" class="form-select" name="categoria_id" required>
                <option selected value="">Opções...</option>
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= $categoria['id']; ?>">
                        <?= $categoria['descricao']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>