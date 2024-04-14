<div class="container">
    <h3 class="text text-center mt-3">Adicinar Nova Categoria</h3>
    <form method="post" action="/proj2/categorias/inserir" style="margin-top: 60px">
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control"
                   id="descricao" name="descricao"
                   placeholder="example: Tonner"
                   autofocus>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>