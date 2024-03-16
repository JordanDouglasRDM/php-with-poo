<?php
require_once '../sidebar/sidebar-in.php';

function getProfessors()
{
    try {
        global $pdo;

        $sql = "SELECT * FROM professores;";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ./home-professor.php');
        exit();
    }
}

function getAllAlunoSemProfessor()
{
    try {
        global $pdo;

        $sql = "SELECT * FROM professores p INNER JOIN alunos a ON a.id = p.aluno_id;";
        $stmt = $pdo->query($sql);
        $professoresComAlunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM alunos;";
        $stmt = $pdo->query($sql);
        $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $idAlunosComProfessor = array_column($professoresComAlunos, 'aluno_id');

        $idAlunos = array_column($alunos, 'id');

        $idAlunosSemProfessor = array_diff($idAlunos, $idAlunosComProfessor);
        return $idAlunosSemProfessor;

    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type_message'] = 'danger';
        header('Location: ./home-professor.php');
        exit();
    }
}

$idAlunosSemProfessor = getAllAlunoSemProfessor();

if (!empty($idAlunosSemProfessor)) {
    $selectedMessage = 'Selecione um aluno para atribuir-se';
    $existe = '';
} else {
    $selectedMessage = 'Não possui alunos disponíveis';
    $existe = 'text-danger';
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
                    window.location.href = `/aula-1/professor/excluir.php?id=${id}`;
                }
            });
        }
    </script>
    <div class="container">
        <h3 class="text-xl-center">Dashboard Professores</h3>
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
            unset($_SESSION['type_message']);
        }
        ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Inserir Novo Professor
        </button>

        <!-- Modal Inserir Professor -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Inserir Novo Professor</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="/professor/inserir.php" method="post">
                            <div class="row">
                                <div>
                                    <label for="nome" class="form-label">Nome: <strong
                                                class="text-danger">*</strong></label>
                                    <input type="text" name="nome" id="nome" class="form-control">
                                </div>
                                <div>
                                    <label for="formacao" class="form-label">Formação: <strong
                                                class="text-danger">*</strong></label>
                                    <input type="text" name="formacao" id="formacao" class="form-control">
                                </div>
                                <div>
                                    <label for="telefone" class="form-label">Telefone: <strong
                                                class="text-danger">*</strong></label>
                                    <input type="number" name="telefone" id="telefone" class="form-control">
                                </div>
                                <div>
                                    <label for="email" class="form-label">Email: <strong class="text-danger">*</strong></label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div>
                                    <label for="select">Aluno Associado: <strong class="text-danger">*</strong></label>
                                    <select id="select" name="aluno_id" class="form-select <?= $existe; ?>"
                                            aria-label="Default select example">
                                        <option selected value=""><?= $selectedMessage ?></option>
                                        <?php
                                        if (isset($idAlunosSemProfessor)):
                                            foreach ($idAlunosSemProfessor as $id): ?>
                                                <option value="<?= $id ?>">aluno_id: <?= $id ?></option>
                                            <?php endforeach;
                                        endif; ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
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
                    <th>Formação</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Aluno_id</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $dados = getProfessors();
                if ($dados):
                    foreach ($dados as $d): ?>
                        <tr>
                            <td><?= $d['id'] ?></td>
                            <td><?= $d['nome'] ?></td>
                            <td><?= $d['formacao'] ?></td>
                            <td><?= $d['telefone'] ?></td>
                            <td><?= $d['email'] ?></td>
                            <td><?= $d['aluno_id'] ?></td>
                            <td class="col-2">
                                <!-- Button trigger modal alterar professor -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#alterarProfessor<?= $d['id']; ?>">
                                    Alterar
                                </button>
                                <a class="btn btn-danger" onclick="confirmDelete(<?= $d['id'] ?>)">Excluir</a>
                            </td>
                        </tr>
                        <!-- Modal Atualizar Professor -->
                        <div class="modal fade" id="alterarProfessor<?= $d['id']; ?>" tabindex="-1"
                             aria-labelledby="alterarProfessor<?= $d['id']; ?>abel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="alterarProfessor<?= $d['id']; ?>abel">Atualizar
                                            Professor '<?= $d['id']; ?>'</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form" action="./alterar.php" method="post">
                                            <input type="hidden" name="id" value="<?= $d['id']; ?>">
                                            <div class="row">
                                                <div>
                                                    <label for="nome" class="form-label">Nome: <strong
                                                                class="text-danger">*</strong></label>
                                                    <input type="text" name="nome" id="nome" class="form-control"
                                                           value="<?= $d['nome'] ?>" required>
                                                </div>
                                                <div>
                                                    <label for="formacao" class="form-label">Formação: <strong
                                                                class="text-danger">*</strong></label>
                                                    <input type="text" name="formacao" id="formacao"
                                                           class="form-control" value="<?= $d['formacao'] ?>" required>
                                                </div>
                                                <div>
                                                    <label for="telefone" class="form-label">Telefone: <strong
                                                                class="text-danger">*</strong></label>
                                                    <input type="number" name="telefone" id="telefone"
                                                           class="form-control" value="<?= $d['telefone'] ?>" required>
                                                </div>
                                                <div>
                                                    <label for="email" class="form-label">Email: <strong
                                                                class="text-danger">*</strong></label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                           value="<?= $d['email'] ?>" required>
                                                </div>
                                                <div>
                                                    <label for="select">Aluno Associado: <strong
                                                                class="text-danger">*</strong></label>
                                                    <select id="select" name="aluno_id" class="form-select" required
                                                            aria-label="Default select example">
                                                        <option value=""><?= $selectedMessage ?></option>
                                                        <option selected value="<?= $d['aluno_id'] ?>">
                                                            aluno_id: <?= $d['aluno_id'] ?></option>
                                                        <?php
                                                        foreach ($idAlunosSemProfessor as $id): ?>
                                                            <option value="<?= $id ?>">aluno_id: <?= $id ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                        <td colspan='7' class="text-danger"><strong>Tabela vazia!</strong></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
require_once '../sidebar/sidebar-out.html';