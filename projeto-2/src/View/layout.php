<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- DataTable -->
    <script defer
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">

    <!-- bootstrap - css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap - js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ícones -->
    <script src="https://kit.fontawesome.com/9f50e2463f.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="/css/view-dash.css">

    <title>Projeto 2</title>
</head>
<body id="meuBody" data-bs-theme="dark">
<nav class="navbar bg-secondary-subtle navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">E-management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-4" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link meuButtonHome fs-5 ms-2" aria-current="page" href="/proj2/home/dash">Home</a>
                </li>
                <li class="nav-item dropdown ms-4">
                    <a class="nav-link dropdown-toggle fs-5" id="nav-link-produtos" href="#" role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Produtos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/proj2/produtos/inserir">Novo Produto</a></li>
                        <li><a class="dropdown-item" href="/proj2/produtos/listar">Listar Produtos</a></li>
                        <li><a class="dropdown-item" href="/proj2/categorias/inserir">Nova Categoria</a></li>
                        <li><a class="dropdown-item" href="/proj2/categorias/listar">Listar Categorias</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown ms-4">
                    <a class="nav-link dropdown-toggle fs-5" id="nav-link-usuarios" href="#" role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Usuários
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/proj2/usuarios/inserir">Novo Usuário</a></li>
                        <li><a class="dropdown-item" href="/proj2/usuarios/listar">Listar Usuários</a></li>
                        <li><a class="dropdown-item" href="/proj2/certificacoes/inserir">Nova Certificação </a></li>
                        <li><a class="dropdown-item" href="/proj2/certificacoes/listar">Listar Certificações</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="navbar-nav ms-md-auto navbar-nav-scroll">
                <li><a href="https://github.com/JordanDouglasRDM" target="_blank" class="nav-link col-lg-auto me-2"><i
                                data-feather="github"></i></a></li>
                <li><a href="https://www.linkedin.com/in/jordan-douglas-rosa-de-melo/" target="_blank"
                       class="nav-link col-lg-auto me-2"><i data-feather="linkedin"></i></a></li>
                <li class="nav-item dropdown ms-4 meuDropDown2">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Temas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" onclick="alterarTema('light')">Light <i
                                        class="fa-regular fa-sun"></i></a></li>
                        <li><a class="dropdown-item" onclick="alterarTema('dark')">Dark <i class="fa-solid fa-moon"></i></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="container">
            <span class="loader meu-loader"></span>
        </div>
    </div>
</div>
<section>
    <?php
    if (isset($path)) {
        include_once $path;
    }
    ?>
</section>
<script src="/js/layout.js"></script>

<script>
    $(document).ready(function () {
        // Inicialização do DataTables com a tradução em português-brasileiro
        $('.data-table-transform').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
            }
        });
    });

    activeButtonsNavbar();
    alterarTema();
    defineStyleDasTable();
    modalOfLoading = defineModalLoading();
</script>
</body>
</html>