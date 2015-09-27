<?php

class Loader
{
    public static function loadClass($className)
    {
        if (file_exists(ROOT . "/" . $className . ".php")) {

            //echo "<br/>load [".$className."]".": "."load: ".$className;
            require_once(ROOT . "/" . $className . ".php");

        } else {
            //echo "<br/>load [ ".$className." ]".": ".ROOT . "/src/Students/" . $className . ".php";
            require_once(ROOT . "/src/Students/" . $className . ".php");
        }
    }
}