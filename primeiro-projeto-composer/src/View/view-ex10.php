<section class="card border-primary container p-5 w-50 mt-5">
    <h3 class="title">Cálculo de IMC:</h3>
    <form class="form row" action="/lista2/ex10/resposta" method="POST">
        <div class="col-7">
            <label for="height">Altura (em metros):</label>
            <input type="number" name="height" id="height" min="0.01" max="2.51" step="0.01" class="form-control"
                   required autofocus>
            <label for="weight">Peso (em kilos):</label>
            <input type="number" name="weight" id="weight" min="0.01" step="0.01" class="form-control" required><br>
            <input type="submit" name="enviar" value="Enviar" class="btn btn-primary mt-3">
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


<?php
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
} else {
    $level = '';
}
echo '
<div class="container mt-5 text-center">
    <table class="table table-hover">
        <thead class="table-secondary">
        <tr>
            <th>IMC</th>
            <th>CLASSIFICAÇÃO</th>
            <th>OBESIDADE (GRAU)</th>
        </tr>
        </thead>
        <tbody>
        <tr class="' . ($level == 1 ? 'table-info' : '') . '">
            <td>MENOR QUE 18,5</td>
            <td>MAGREZA</td>
            <td>0</td>
        </tr>
        <tr class="' . ($level == 2 ? 'table-info' : '') . '">
            <td>ENTRE 18,5 E 24,9</td>
            <td>NORMAL</td>
            <td>0</td>
        </tr>
        <tr class="' . ($level == 3 ? 'table-info' : '') . '">
            <td>ENTRE 25,0 E 29,9</td>
            <td>SOBREPESO</td>
            <td>I</td>
        </tr>
        <tr class="' . ($level == 4 ? 'table-info' : '') . '">
            <td>ENTRE 30,0 E 39,9</td>
            <td>OBESIDADE</td>
            <td>II</td>
        </tr>
        <tr class="' . ($level == 5 ? 'table-info' : '') . '">
            <td>MAIOR QUE 40,0</td>
            <td>OBESIDADE GRAVE</td>
            <td>III</td>
        </tr>
        </tbody>
    </table>
</div>
';

unset($_SESSION['level']);
?>
