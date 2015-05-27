<?php

class Router
{
    private $route = array();

    public function AddPage($url, $controller, $method)
    {
        $this->route[$url] = array(
            'controller' => $controller,
            'method' => $method
        );
    }

    public function getPage($url)
    {
        if (isset($this->route[$url]))
            return $this->route[$url];

        return false;
    }
}