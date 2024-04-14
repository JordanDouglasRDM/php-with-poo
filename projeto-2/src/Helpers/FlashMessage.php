<?php

namespace Php\Projeto2\Helpers;

class FlashMessage
{
    static public function showMessage(): void
    {
        if (isset($_SESSION['returns'])) {
            if ($_SESSION['returns']['success']) {
                echo '
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>Sucesso! </strong>' . $_SESSION["returns"]["message"] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        ';
            } else {
                echo '
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Houve um erro! </strong>' . $_SESSION["returns"]["message"] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        ';
            }

            unset($_SESSION['returns']);
        }
    }
}