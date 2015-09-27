<?php

namespace framework;

use ReflectionClass;

class Router
{
    private static $router;

    private $registry;

    private function __construct($registry)
    {
        $this->registry = $registry;
    }

    public static function getInstance($registry)
    {
        if (Router::$router == null) {
            Router::$router = new Router($registry);
        }
        return Router::$router;
    }

    /**
     * @param string $path
     */
    public function getController($path)
    {
        $pathParts = explode('/', substr($path, 1));

        if ($pathParts[0] == "") {

            $controllerName = "index";
            return array("controller" => $controllerName);

        } else {

            $controllerName = "controller\\" . $pathParts[0] . "Controller";
            $controllerClass = new ReflectionClass($controllerName);
            $controller = $controllerClass->newInstanceArgs(array($this->registry));

            $action = "index";
            if (count($pathParts) > 1 && $pathParts[1] != "") {
                $action = $pathParts[1];
            }

            return array("controller" => $controller, "action" => $action);
        }
    }
}