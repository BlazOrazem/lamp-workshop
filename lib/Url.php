<?php

class Url
{
    protected $routes;

    public function __construct()
    {
        $this->routes = $this->getRoutes();
    }

    public function getController()
    {
        if ($this->routes[0] == 'admin') {
            array_shift($this->routes);
            if (!isset($this->routes[0])) {
                $this->routes[0] = '';
            }

            return 'AdminController';
        }

        return $this->getDefaultController();
    }

    public function getMethod()
    {
        if (empty($this->routes[0])) {
            array_shift($this->routes);

            return $this->getDefaultMethod();
        }

        return 'run' . ucfirst($this->routes[0]);
    }
    
    public function getParam()
    {
        if (isset($this->routes[1])) {
            return $this->routes[1];
        }

        return null;
    }
    
    protected function getRoutes()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        $routes = explode('/', $uri);

        return $routes;
    }

    protected function getDefaultController()
    {
        return 'BaseController';
    }

    protected function getDefaultMethod()
    {
        return 'runIndex';
    }
}
