<section class="card border-primary container p-5 w-50 mt-5">
    <h3 class="title">Cálculo de anos:</h3>
    <form class="form row" action="/lista2/ex9/resposta" method="POST">
        <div class="col-7">
            <label for="anoNascimento" class="form-label fs-5 mt-2">Informe o ano de nascimento:</label>
            <input type="number" id="anoNascimento" name="anoNascimento" class="form-control" autofocus required>
            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </div>
    </form>

</section>
<div class="container mt-5">
    <?php if (isset($_SESSION['message'])): ?>
        <alert class="alert alert-info">Response: <?= $_SESSION['message']; ?></alert>
        <div class="container mt-5">
            <ul class="list-group" style="max-height: 20rem;overflow-y: scroll;">
                <?= $_SESSION['idades']; ?>
            </ul>
        </div>
        <?php
        unset($_SESSION['message'], $_SESSION['idades']);
    endif;
    ?>
</div>
