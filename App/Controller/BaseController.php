<?php
namespace App\Controller;

class Basecontroller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->validator = \Psecio\Validation\Validator::getInstance('request.slim3');
    }

    public function render($view, array $data = [])
    {
        $request = $this->container->get('response');
        return $this->container->view->render($request, $view, $data);
    }

    public function __get($property)
    {
        if ($property == 'user') {
            return $this->container->session->get('user');
        }
        if (isset($this->container, $property)) {
            return $this->container->$property;
        }
        return null;
    }

    public function verify($request, array $rules, array $messages = [])
    {
        return $this->validator->execute($request, $rules, $messages);
    }

    public function jsonResponse($status, $message = null, array $addl = [])
    {
        $output = ['success' => $status];
        if ($message !== null) {
            $output['message'] = $message;
        }
        if (!empty($addl)) {
            $output = array_merge($output, $addl);
        }

        $response = $this->response->withHeader('Content-type', 'application/json');
        $body = $response->getBody();
        $body->write(json_encode($output));

        return $response;
    }
    public function jsonFail($message = null, array $addl = [])
    {
        return $this->jsonResponse(false, $message, $addl);
    }
    public function jsonSuccess($message = null, array $addl = [])
    {
        return $this->jsonResponse(true, $message, $addl);
    }
}
