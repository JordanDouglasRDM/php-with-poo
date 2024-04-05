<section class="card border-primary container p-5 w-50 mt-5">
    <h3 class="title">Cálculo de tinta:</h3>
    <form class="form row" action="/lista2/ex8/resposta" method="POST">
        <div class="col-7">
            <label for="number" class="form-label fs-5 mt-2">Informe a área a ser pintada em M²:</label>
            <input type="number" step="0.01" id="number" name="number" class="form-control" autofocus required>
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
