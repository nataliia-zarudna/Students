<?php

namespace framework\core;

class Loader
{
    /**
     * @param string $className
     */
    public static function loadClass($className)
    {
        if (file_exists(ROOT . "/" . $className . ".php")) {

            //echo "<br/>".ROOT . "/" . $className . ".php";
            require_once(ROOT . "/" . $className . ".php");

        } else {

            //echo "<br/>".ROOT . "/src/Students/" . $className . ".php";
            require_once(ROOT . "/src/Students/" . $className . ".php");
        }
    }
}