const meusTd = document.querySelectorAll('.open-modal-certificacoes');
const saveChangesCertificacaoButtons = document.querySelectorAll('.save-changes-certificacoes');
const deleteButtons = document.querySelectorAll('.excluir-certificacao');


//define o click na linha para abrir o modal de edição
meusTd.forEach((td) => {
    td.setAttribute('data-bs-toggle', 'modal');
    td.setAttribute('data-bs-target', '#editarCertificacao' + td.id);
    td.style.cursor = 'pointer';
});

//adiciona uma confirmação de exclusão
deleteButtons.forEach((bt) => {
    bt.addEventListener('click', function (event) {
        event.preventDefault();
        const form = bt.closest('form');
        confirmarExclusao(form);
    })
});

//envia o formulário para alterar um usuário
saveChangesCertificacaoButtons.forEach((button) => {
    button.addEventListener('click', function () {
        const form = document.getElementById(button.id);
        form.submit();
    })
});