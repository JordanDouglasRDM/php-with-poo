<?php

namespace Php\Projeto2\Traits;

trait RedirectToPageTrait
{
    protected function redirectTo(array $returns, string $location): void
    {
        $_SESSION['returns'] = $returns;
        header('Location: ' . $location);
        exit();
    }
}