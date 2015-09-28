<?php

use framework\core\Registry;
use framework\core\Response;
use framework\core\Router;
use framework\core\Request;
use framework\core\view\Template;
use framework\core\log\Logger;
use framework\core\ConfigManager;

define('ROOT',  $_SERVER['DOCUMENT_ROOT'] );

require_once(ROOT . "/framework/core/loader.php");
spl_autoload_register(array("framework\core\Loader", "loadClass"));

$registry = new Registry();

$db = new PDO(ConfigManager::getConfig("db"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$registry["db"] = $db;

$logger = new Logger(ROOT.ConfigManager::getConfig("log_file"));
$registry["logger"] = $logger;

$router = Router::getInstance($registry);

if(isWebFileRequested() > 0) {

    readfile(ROOT.$_SERVER['REQUEST_URI']);

} else {

    $urlParts = explode('?', $_SERVER['REQUEST_URI'], 2);
    $request = new Request($urlParts[0]);
    $request->setParams($_REQUEST);
    $response = new Response();

    $controllerData = $router->getController($request->getUrl());
    $controller = $controllerData["controller"];
    if ($controller != "index") {

        $action = $controllerData["action"];

        $view = $controller->$action($request, $response);

        if($response->getPath() == "") {
            $response->setPath(ROOT . "/src/Students/view");
        }

        $template = new Template($view, $response);
        $template->show();

    } else {
        $response->sendRedirect("students");
    }
}

function isWebFileRequested() {
    return preg_match('/\/web\//',$_SERVER['REQUEST_URI']);
}
?>



