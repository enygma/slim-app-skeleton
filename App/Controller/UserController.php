<?php

namespace App\Controller;
use App\Lib\Connector\Twitter;

class UserController extends \App\Controller\BaseController
{
    public function dashboard()
    {
        $twitter = new Twitter($this->container);
        $data = [
            'twitter_url' => $twitter->buildUrl(),
            'connectors' => $this->user->connectors
        ];
        return $this->render('/user/dashboard.php', $data);
    }

    public function logout()
    {
        $this->session->set('user', null);
        return $this->response->withRedirect('/');
    }
}
