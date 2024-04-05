<section class="card border-primary container p-5 w-50 mt-5">
    <h3 class="title">Ordenar Números:</h3>
    <form class="form row" action="/lista2/ex2/resposta" method="POST">
        <label for="numbers" class="form-label fs-5 mt-2">Digite 7 números separados por "," (vírgula):</label>
        <div class="col-5 input-group">
            <input type="text" id="numbers" name="numbers" class="form-control" autofocus placeholder="ex: 12,15,0,-9...">
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
