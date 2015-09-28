<?php

namespace framework\core;

use ReflectionClass;

class Router
{
    private $registry;

    private static $router;

    /**
     * @param Registry $registry
     */
    private function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param Registry $registry
     * @return Router
     */
    public static function getInstance($registry)
    {
        if (Router::$router == null) {
            Router::$router = new Router($registry);
        }
        return Router::$router;
    }

    /**
     * @param string $path
     * @return array
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