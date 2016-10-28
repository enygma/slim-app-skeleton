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

    public function __get($property)
    {
        if (isset($this->container, $property)) {
            return $this->container->$property;
        }
        return null;
    }

    public function verify($request, $rules)
    {
        $validator = \Psecio\Validation\Validator::getInstance('request.slim3');
        return $validator->execute($request, $rules);
    }
}
