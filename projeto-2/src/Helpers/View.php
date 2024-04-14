<?php

namespace Php\Projeto2\Helpers;

class View
{
    private string $src;
    public array $view;
    public function __construct(string $src)
    {
        $this->src = $src;
        $this->setView();
    }

    public function getView(): array
    {
        return $this->view;
    }
    private function setView(): void
    {
        //converte um caminho de url em um objeto de view
        $srcExploded = explode('/', $this->src);
        $srcExploded[0] = $this->src;

        $this->view = $srcExploded;
    }
}