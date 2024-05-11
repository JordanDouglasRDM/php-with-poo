function defineModalLoading() {
    const modal = new bootstrap.Modal(document.getElementById('my-modal'), {
        keyboard: false,
        backdrop: 'static'
    });
    return modal;
}

function alterarTema() {
    const tema = localStorage.getItem('temaSelecionado');
    localStorage.setItem('temaSelecionado', tema);
    const meuBody = document.getElementById("meuBody");
    meuBody.setAttribute('data-bs-theme', tema);
}

// Selecionando elementos do DOM
function activeButtonsNavbar() {
    const buttonHome = document.querySelector('.meuButtonHome');
    const dropdownItems = document.querySelectorAll('.dropdown-item');

    // Obtendo a URL atual e suas partes
    const currentUrl = window.location.href;
    const currentDirectoryArray = currentUrl.split('/');
    const lastIndex = currentDirectoryArray.length - 1;
    const entity = currentDirectoryArray[lastIndex - 1];
    const action = currentDirectoryArray[lastIndex];

    // Adicionando classe 'active' com base na URL
    if (action === 'dash') {
        buttonHome.classList.add('active');
    } else {
        if (entity === 'produtos' || entity === 'categorias') {
            document.getElementById('nav-link-produtos').classList.add('active');
        } else {
            document.getElementById('nav-link-usuarios').classList.add('active');
        }
    }

    // Adicionando classe 'active' aos itens do dropdown
    dropdownItems.forEach((item) => {
        const urlSplit = item.href.split('/');
        const itemEntity = urlSplit[urlSplit.length - 2];
        const itemAction = urlSplit[urlSplit.length - 1];

        const currentUrlParts = `${entity}/${action}`;
        const itemUrlParts = `${itemEntity}/${itemAction}`;
        if (currentUrlParts === itemUrlParts) {
            item.classList.add('active');
        }
    });
}


function confirmarExclusao(formulario) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "ms-3 btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "Tem certeza que deseja excluir?",
        text: "Essa ação não pode ser desfeita.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, entendo os riscos!",
        cancelButtonText: "Cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            formulario.submit();

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.close()
        }
    });
}

//     formatação de style das table
function defineStyleDasTable() {
    const minhasTh = document.querySelectorAll('th');
    const minhasTd = document.querySelectorAll('td');
    minhasTh.forEach((th) => {
        th.className = 'text-center';
    });
    minhasTd.forEach((td) => {
        td.className = 'text-center';
    });
}