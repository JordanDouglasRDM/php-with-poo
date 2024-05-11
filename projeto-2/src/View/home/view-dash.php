<div class="container" style="margin-top: 10%">
    <div class="container-cards d-flex justify-content-around">
        <div class="card" style="width: 18rem;">
            <img height="220" src="/../../../assets/img/alimentos.jpg" class="card-img-top"
                 alt="Imagem com alimentos sortidos">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <p class="card-text">Gerenciamento de produtos e categorias de produtos.</p>
                <a href="/proj2/produtos/listar" class="btn btn-primary">Produtos</a>
                <a href="/proj2/categorias/listar" class="btn btn-primary">Categorias</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img height="220" src="/../../../assets/img/avatar.jpg" class="card-img-top"
                 alt="Imagem com alimentos sortidos">
            <div class="card-body">
                <h5 class="card-title">Usuários</h5>
                <p class="card-text">Gerenciamento de Usuários e certificados.</p>
                <a href="/proj2/usuarios/listar" class="btn btn-primary">Usuários</a>
                <a href="/proj2/certificacoes/listar" class="btn btn-primary">Certificados</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img height="220" src="/../../../assets/img/database.jpg" class="card-img-top"
                 alt="Imagem com alimentos sortidos">
            <div class="card-body">
                <h5 class="card-title">Dados</h5>
                <p class="card-text">Como funcionalidade adicional, você pode gerar dados fakes para todas as
                    tabelas.</p>
                <div class="d-flex justify-content-around">
                    <button type="submit" id="data-generate" class="btn btn-outline-success justify-content-around">
                        Gerar
                    </button>
                    <button type="submit" id="data-clear" class="btn btn-outline-danger ms-4">Limpar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/home/view-dash.js"></script>