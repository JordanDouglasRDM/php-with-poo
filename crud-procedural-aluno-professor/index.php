<?php
require_once 'sidebar/sidebar-in.php';
function getAlunos()
{
    try {
        global $pdo;

        $sql = "SELECT a.*, p.nome as professor_nome FROM alunos a LEFT JOIN professores p ON a.id = p.aluno_id;";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ../aula-1/index.php');
        exit();
    }
}

?>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Tem certeza que deseja excluir?",
                text: "Você não pode reverter isso depois!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Sim",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url;
                    url = '/aula-1/aluno/excluir.php?id=' + id;
                    window.location.href = url;
                }
            });
        }
    </script>
    <div class="container">
        <h3 class="text-xl-center">Dashboard Alunos</h3>
        <?php
        if (isset($_SESSION['message'])) {
            ?>
            <div class="alert alert-<?= $_SESSION['type_message']; ?> alert-dismissible fade show text-center"
                 role="alert">
                <strong><?= $_SESSION['message']; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['message']);
        }
        ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Inserir Novo Aluno
        </button>

        <!-- Modal Inserir Aluno -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Inserir Novo Aluno</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="" action="/aluno/inserir.php" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <label for="nome" class="form-label">Informe o nome: <strong
                                                class="text-danger">*</strong></label>
                                    <input type="text" name="nome" id="nome" class="form-control" autofocus required>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Informe o curso: <strong
                                                class="text-danger">*</strong></label>
                                    <input type="text" name="curso" id="curso" class="form-control" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <!--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                        <input type="submit" value="Adicionar" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-height">
            <table class="table table-striped table-hover text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Professor Associado</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $dados = getAlunos();
                if ($dados):
                    foreach ($dados as $d): ?>
                        <tr>
                            <td><?= $d['id'] ?></td>
                            <td><?= $d['nome'] ?></td>
                            <td><?= $d['curso'] ?></td>
                            <td><?= $d['professor_nome'] ?></td>
                            <td class="col-2">
                                <!-- Button trigger modal alterar aluno -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#alterarAluno<?= $d['id']; ?>">
                                    Alterar
                                </button>
                                <a class="btn btn-danger" onclick="confirmDelete(<?= $d['id'] ?>)">Excluir</a>
                            </td>
                        </tr>
                        <!-- Modal Atualizar Aluno -->
                        <div class="modal fade" id="alterarAluno<?= $d['id']; ?>" tabindex="-1"
                             aria-labelledby="alterarAluno<?= $d['id']; ?>abel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="alterarAluno<?= $d['id']; ?>abel">Atualizar
                                            Aluno '<?= $d['id']; ?>'</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/aluno/alterar.php" method="post">
                                            <input type="hidden" name="id" value="<?= $d['id']; ?>">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="nome" class="form-label">Nome:</label>
                                                    <input type="text" name="nome" id="nome" class="form-control"
                                                           value="<?= $d['nome']; ?>">
                                                </div>
                                                <div class="col-6">
                                                    <label for="" class="form-label">Curso:</label>
                                                    <input type="text" name="curso" id="curso" class="form-control"
                                                           value="<?= $d['curso']; ?>">
                                                </div>
                                                <div class="col-12">
                                                    <label for="" class="form-label">Professor Associado:</label>
                                                    <input type="text" name="" id="" class="form-control"
                                                           value="<?= $d['professor_nome']; ?>" disabled>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Atualizar" class="btn btn-success">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan='5' class="text-danger"><strong>Tabela vazia!</strong></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
require_once 'sidebar/sidebar-out.html';