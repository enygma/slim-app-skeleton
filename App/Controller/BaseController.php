<?php
namespace App\Controller;

class Basecontroller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function render($view, array $data = [])
    {
        $request = $this->container->get('response');
        return $this->container->view->render($request, $view, $data);
    }
}
