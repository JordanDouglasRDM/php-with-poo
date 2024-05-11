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

            setTimeout(() => {
                modalOfLoading.hide()
            }, 500);

            setTimeout(() => {
                Toast.fire({
                    icon: "success",
                    title: "Dados gerados com sucesso!",
                    text: response.data.message
                });
            }, 500);

        })
        .catch(function (error) {
            console.error('Erro:', error);
            const message = error.response.data.message;
            const errorCode = error.response.status;

            setTimeout(() => {
                modalOfLoading.hide()
            }, 500);

            Toast.fire({
                icon: "error",
                title: 'Falha ao gerar dados',
                html: `<p>Erro: ${message}<br>Código: ${errorCode}<br>Tente novamente mais tarde</p>`
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
                    title: "Dados excluidos com sucesso!",
                    text: response.data.message
                });
            }, 500);

        })
        .catch(function (error) {

            const message = error.response.data.message;
            const errorCode = error.response.status;

            setTimeout(() => {
                modalOfLoading.hide()
            }, 500);

            Toast.fire({
                icon: "error",
                title: 'Falha ao excluir dados',
                html: `<p>Erro: ${message}<br>Código: ${errorCode}<br>Tente novamente mais tarde</p>`
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