<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/9f50e2463f.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body id="meuBody" data-bs-theme="dark">
<nav class="navbar bg-secondary-subtle navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Fatec - PHP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-4" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link meuButtonHome fs-5 ms-2" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown ms-4 meuDropDown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Atividades
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/lista2/ex1">Exercício 1</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex2">Exercício 2</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex3">Exercício 3</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex4">Exercício 4</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex5">Exercício 5</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex6">Exercício 6</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex7">Exercício 7</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex8">Exercício 8</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex9">Exercício 9</a></li>
                        <li><a class="dropdown-item" href="/lista2/ex10">Exercício 10</a></li>
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

<section>
    <?php echo $content ?? ''; ?>
</section>
<script>
    let temaSalvo = localStorage.getItem('temaSelecionado');
    if (temaSalvo) {
        alterarTema(temaSalvo);
    }

    let meuButtonHome = document.querySelector('.meuButtonHome');
    let dropdownItems = document.querySelectorAll('.dropdown-item');
    let meuDropDown = document.querySelector('.meuDropDown');
    let currentUrl = window.location.href;
    let currentDirectoryArray = currentUrl.split('/');
    let positionArray = currentDirectoryArray.length - 1;
    let currentDirectory = currentDirectoryArray[positionArray];

    if (currentDirectory === 'lab-eng-atividades') {
        meuButtonHome.classList.add('active');
    } else {
        let ultimaPosicaoDiretorio = currentDirectory.length - 1
        let valorACompararDir = currentDirectory[ultimaPosicaoDiretorio];

        meuDropDown.classList.add('active')
        dropdownItems.forEach((li) => {
            let ultimaPosicaoLi = li.textContent.length - 1
            let valorAComparar = li.textContent[ultimaPosicaoLi];
            if (valorACompararDir === valorAComparar) {
                li.classList.add('active')
            }
        });
    }

    function alterarTema(tema) {
        localStorage.setItem('temaSelecionado', tema);
        const meuBody = document.getElementById("meuBody");
        meuBody.setAttribute('data-bs-theme', tema);
    }
</script>
</body>
</html>