<?php

namespace Php\Projeto2\Controller;

use Symfony\Component\HttpFoundation\Response;

class FrontController
{
//rederiza o layout com a view
    public function renderViewMain(array $view, array $data = []): string
    {
        $pathView = $this->renderView($view);
        $layoutContent = $this->renderLayout($pathView, $data);

        $response = new Response($layoutContent);

        return $response->getContent();
    }

    //renderiza o layout
    private function renderLayout(string $path, array $data = []): string
    {
        ob_start();
        extract($data);

        include_once(__DIR__ . '/../View/layout.php');
        return ob_get_clean();
    }

    //renderiza a view
    private function renderView(array $view): string
    {
        return $this->validateView($view);
    }

    private function validateView(array $view): string
    {
        $dir = filter_var($view[1]);
        $file = filter_var($view[2]);

        $path = __DIR__ . "/../View/$dir/view-$file.php";

        if (file_exists($path)) {
            return $path;
        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }
}