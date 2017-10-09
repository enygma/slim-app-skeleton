<?php

namespace App\Traits;

trait FlashMessage
{
    public function getFlash()
    {
        $flash = $this->container->get('session')->get('flash_message');
        if ($flash !== null) {
            $this->container->get('session')->set('flash_message', null);
        }
        return $flash;
    }
    public function setFlash($message, $type = 'success')
    {
        error_log('setting: '.print_r($message, true));
        $this->container->get('session')->set(
            'flash_message',
            ['type' => $type, 'message' => $message]
        );
    }
}
