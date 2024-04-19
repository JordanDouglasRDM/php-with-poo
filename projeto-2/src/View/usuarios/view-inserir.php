<div class="container w-50 border border-secondary mt-3 pb-3">
    <h3 class="text text-center mt-3">Adicinar Novo Usuário</h3>
    <form class="row g-3" method="post" action="/proj2/usuarios/inserir" style="margin-top: 60px">
        <div class="input-group col-md-6">
            <label for="nome" class="input-group-text">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome" autofocus required>
        </div>
        <div class="input-group col-md-6">
            <label for="cpf" class="input-group-text">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" maxlength="11" minlength="11">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>
</div>