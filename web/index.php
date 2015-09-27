<?php

use framework\Registry;
use framework\Router;
use framework\Request;
use framework\Template;
use framework\Logger;

define('ROOT',  $_SERVER['DOCUMENT_ROOT'] );

require_once(ROOT . "/framework/loader.php");
spl_autoload_register(array("Loader", "loadClass"));

$registry = new Registry();

$db = new PDO(getConfig("db"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$registry["db"] = $db;

$logger = new Logger(ROOT.getConfig("log_file"));
$registry["logger"] = $logger;

$router = Router::getInstance($registry);

if(preg_match('/^\/web\//',$_SERVER['REQUEST_URI']) > 0) {

    readfile(ROOT.$_SERVER['REQUEST_URI']);

} else {

    $urlParts = explode('?', $_SERVER['REQUEST_URI'], 2);
    $request = new Request($urlParts[0]);
    $request->setParams($_REQUEST);

    $controllerData = $router->getController($request->getUrl());
    $controller = $controllerData["controller"];
    if ($controller != "index") {

        $action = $controllerData["action"];

        $response = $controller->$action($request);

        $response->setPath(ROOT."/src/Students/view");

        $view = new Template($response);
        $view->show();
    }

    else {
        header("Location: /students");
    }
}

function getConfig($name) {

    $file = fopen(ROOT."/app/config.properties", "r");
    if($file) {

        while(($line = fgets($file)) !== false) {
            if(preg_match('/^'.$name.'/', $line) > 0) {

                $value = explode("=", $line)[1];
                return trim($value);
            }
        }
    } else {
        //TODO handle exception
    }
}
?>



