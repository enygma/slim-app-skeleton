<?php

namespace App\View;
use \Psr\Http\Message\ResponseInterface;

class TemplateView extends \Slim\Views\Twig
{
    use \App\Traits\FlashMessage;

    public function render(ResponseInterface $response, $template, $data = [])
    {
        $this->container = $this['container'];
        $session = $this['container']->get('session');

        // See if we have a user
        $user = $session->get('user');
        if ($user !== null) {
            $data['user'] = $user;
        }

        $flash = $this->getFlash();
        if ($flash !== null) {
            error_log('getting: '.print_r($flash, true));
            $data['flash_message'] = $flash;
        }

        parent::render($response, $template, $data);
    }
}
