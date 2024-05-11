function openModalByClickOnRowTable(sufixId, seletorTd) {

    document.querySelectorAll(seletorTd).forEach((td) => {
        td.setAttribute('data-bs-toggle', 'modal');
        td.setAttribute('data-bs-target', '#' + sufixId + td.id);
        td.style.cursor = 'pointer';
    });
}
openModalByClickOnRowTable('editarUsuario', '.open-modal');

const saveChangesButtons = document.querySelectorAll('.save-changes');
const deleteButtons = document.querySelectorAll('.excluir-usuario');


//adiciona uma confirmação de exclusão
deleteButtons.forEach((bt) => {
    bt.addEventListener('click', function (event) {
        event.preventDefault();
        const form = bt.closest('form');
        confirmarExclusao(form);
    })
});

//envia o formulário para alterar um usuário
saveChangesButtons.forEach((button) => {
    button.addEventListener('click', function () {
        const form = document.getElementById(button.id);
        form.submit();
    })
});