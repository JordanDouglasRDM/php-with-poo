<section class="card border-primary container p-5 w-50 mt-5">
    <h3 class="title">Verificar Números:</h3>
    <form class="form row" action="/lista2/ex1/resposta" method="POST">
        <label for="number" class="form-label fs-5 mt-2">Digite um número:</label>
        <div class="col-5 input-group">
            <input type="number" step="0.01" id="number" name="number" class="form-control" autofocus>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>

</section>
<div class="container mt-5">
    <?php if (isset($_SESSION['message'])): ?>
        <alert class="alert alert-info">Response: <?= $_SESSION['message'];?></alert>
        <?php
        unset($_SESSION['message']);
    endif;
    ?>
</div>
