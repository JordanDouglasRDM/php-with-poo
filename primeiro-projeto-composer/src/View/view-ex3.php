<section class="card border-primary container p-5 w-50 mt-5">
    <h3 class="title">Soma de dois números:</h3>
    <form class="form row" action="/lista2/ex3/resposta" method="POST">
        <div class="col-7">
            <label for="number1" class="form-label fs-5 mt-2">Informe o 1° número:</label>
            <input type="number" step="0.01" id="number1" name="number1" class="form-control" autofocus required>
            <label for="number2" class="form-label fs-5 mt-2">Informe o 2° número:</label>
            <input type="number" step="0.01" id="number2" name="number2" class="form-control" required>
            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </div>
    </form>

</section>
<div class="container mt-5">
    <?php if (isset($_SESSION['message'])): ?>
        <alert class="alert alert-info">Response: <?= $_SESSION['message']; ?></alert>
        <?php
        unset($_SESSION['message']);
    endif;
    ?>
</div>
