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

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    const gerar = document.getElementById('data-generate');
    const limpar = document.getElementById('data-clear');


    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "ms-3 btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    function gerarDados() {
        modalOfLoading.show()
        axios.post('/proj2/rollback/seeder')
            .then(function (response) {
                // const endTime = new Date().getTime();
                // const elapsedTime = endTime - startTime;
                setTimeout(() => {
                    modalOfLoading.hide()
                }, 500);

                setTimeout(() => {
                    Toast.fire({
                        icon: "success",
                        title: "Dados gerados com sucesso!"
                    });
                }, 500);

            })
            .catch(function (error) {
                console.error('Erro:', error);

                setTimeout(() => {
                    modalOfLoading.hide()
                }, 500);

                Toast.fire({
                    icon: "error",
                    title: "Falha ao gerar dados",
                    text: "Tente novamente mais tarde"
                });
            });
    }

    function limparDados() {
        modalOfLoading.show()
        axios.post('/proj2/rollback')
            .then(function (response) {
                setTimeout(() => {
                    modalOfLoading.hide()
                }, 500);

                setTimeout(() => {
                    Toast.fire({
                        icon: "success",
                        title: "Dados excluidos com sucesso!"
                    });
                }, 500);

            })
            .catch(function (error) {
                console.error('Erro:', error);

                setTimeout(() => {
                    modalOfLoading.hide()
                }, 500);

                Toast.fire({
                    icon: "error",
                    title: "Falha ao excluir dados",
                    text: "Tente novamente mais tarde"
                });
            });
    }

    gerar.addEventListener('click', function (event) {
        event.preventDefault();
        swalWithBootstrapButtons.fire({
            title: "Tem certeza que deseja gerar os dados?",
            text: "Isso vai apagar tudo o que você possui cadastrado e criar outros novos dados aleatórios",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, entendo os riscos!",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                gerarDados()
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.close()
            }
        });
    });
    limpar.addEventListener('click', function (event) {
        event.preventDefault();
        swalWithBootstrapButtons.fire({
            title: "Tem certeza que deseja limpar os dados?",
            text: "Isso vai apagar TODOS os dados, e esta ação não poderá ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, entendo os riscos!",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                limparDados();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.close()
            }
        });
    })
</script>