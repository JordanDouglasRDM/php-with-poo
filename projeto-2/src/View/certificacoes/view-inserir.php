<?php
$usuario = new \Php\Projeto2\Model\DAO\UsuarioDao();
$daoResponse = $usuario->getALl();
$usuarios = $daoResponse['model'];

?>
<div class="container w-50 border border-secondary mt-3 pb-3">
    <h3 class="text text-center mt-3">Adicinar Nova Certificação</h3>
    <form class="row g-3" method="post" action="/proj2/certificacoes/inserir" style="margin-top: 60px">
        <div class="input-group col-md-6">
            <label for="titulo" class="input-group-text">Titulo</label>
            <input type="text" name="titulo" class="form-control" id="titulo" autofocus required>
        </div>
        <div class="input-group col-md-6">
            <label for="descricao" class="input-group-text">Descrição</label>
            <input type="text" name="descricao" class="form-control" id="descricao" required>
        </div>
        <div class="input-group col-md-6">
            <label for="empresa" class="input-group-text">Empresa</label>
            <input type="text" name="empresa" class="form-control" id="empresa" required>
        </div>
        <div class="input-group col-md-6">
            <label class="input-group-text" for="inputState">Usuarios</label>
            <select id="inputState" class="form-select" name="usuarios_id" required>
                <option selected value="">Opções...</option>
                <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?= $usuario['id']; ?>">
                        <?= $usuario['nome']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>