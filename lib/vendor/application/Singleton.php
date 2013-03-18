<?php

namespace Application;


class Singleton 
{
    protected static $instance = null;
    protected $props = array();

    private function __construct(){}
    private function __clone(){}
    public function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setProperty($key,$props)
    {
        $this->props[$key] = $props;
    }

    public function getProperty($key)
    {
        return $this->props[$key];
    }

    public function getProps()
    {
        return $this->props;
    }

}