<?php

namespace App;

abstract class Job
{
    protected $container;

    public function __construct($container)
    {
        $this->setContainer($container);
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }
    public function getContainer()
    {
        return $this->container;
    }

    public function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] '.$message."\n";
    }

    public abstract function execute();
}
