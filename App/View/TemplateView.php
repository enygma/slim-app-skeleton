<?php

namespace App\View;
use \Psr\Http\Message\ResponseInterface;

class TemplateView extends \Slim\Views\Twig
{
    public function render(ResponseInterface $response, $template, $data = [])
    {
        // This is where you'd load things for the entire template to use

        parent::render($response, $template, $data);
    }
}
