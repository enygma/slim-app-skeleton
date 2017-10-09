<?php

namespace App\Lib;

abstract class Connector
{
    protected $container;
    protected $config;

    public function __construct($container, $config = null)
    {
        $this->setContainer($container);
        if ($config !== null) {
            $this->setConfig($config);
        }
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }
    public function getContainer()
    {
        return $this->container;
    }

    public function setConfig($config)
    {
        $this->config = json_decode($config);
    }
    public function getConfig()
    {
        return $this->config;
    }

    public abstract function getProvider(array $addl = []);
    public abstract function post($message);
}
